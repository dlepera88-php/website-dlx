<?php
/**
 * MIT License
 *
 * Copyright (c) 2018 PHP DLX
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Website\Application\Services\Adapters\Analytics;


use Google_Client;
use Google_Exception;
use Google_Service_Analytics;
use Google_Service_AnalyticsReporting;
use Google_Service_AnalyticsReporting_DateRange;
use Google_Service_AnalyticsReporting_GetReportsRequest;
use Google_Service_AnalyticsReporting_GetReportsResponse;
use Google_Service_AnalyticsReporting_Metric;
use Google_Service_AnalyticsReporting_ReportRequest;
use Website\Domain\Common\Adapters\AnalyticsAdapterInterface;

/**
 * Class GoogleAnalyticsAdapter
 * @package Website\Application\Services\Adapters\Analytics
 * @covers GoogleAnalyticsAdapterTest
 */
class GoogleAnalyticsAdapter extends AbstractAnalytics implements AnalyticsAdapterInterface
{
    /**
     * @var Google_Service_AnalyticsReporting
     */
    private $analytics;
    /**
     * @var string
     */
    private $json_key;
    /**
     * @var string|null
     */
    private $nome_app;

    /**
     * AnalyticsAdapter constructor.
     * @param string $json_key
     * @param string|null $nome_app
     */
    public function __construct(string $json_key, ?string $nome_app = null)
    {
        $this->json_key = $json_key;
        $this->nome_app = $nome_app;
    }

    /**
     * Conectar no serviço do Google
     * @throws Google_Exception
     */
    public function conectar(): void
    {
        $google_client = new Google_Client();
        $google_client->setApplicationName($this->nome_app);
        $google_client->setAuthConfig($this->json_key);
        $google_client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

        $this->analytics = new Google_Service_AnalyticsReporting($google_client);
    }

    /**
     * Gerar request para enviar ao Google Analytics
     * @return Google_Service_AnalyticsReporting_ReportRequest
     */
    private function gerarRequest(): Google_Service_AnalyticsReporting_ReportRequest
    {
        // Create the DateRange object.
        $range_data = new Google_Service_AnalyticsReporting_DateRange();
        $range_data->setStartDate($this->getDataInicial()->format('Y-m-d'));
        $range_data->setEndDate($this->getDataFinal()->format('Y-m-d'));

        $lista_metricas = [];

        foreach ($this->getMetricas() as $metrica) {
            // Create the Metrics object.
            $g_metrica = new Google_Service_AnalyticsReporting_Metric();
            $g_metrica->setExpression("ga:{$metrica}");
            $g_metrica->setAlias($metrica);

            $lista_metricas[] = $g_metrica;
        }

        // Create the ReportRequest object.
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($this->getViewId());
        $request->setDateRanges($range_data);
        $request->setMetrics($lista_metricas);

        return $request;
    }

    /**
     * @param Google_Service_AnalyticsReporting_ReportRequest $google_request
     * @return Google_Service_AnalyticsReporting_GetReportsResponse
     */
    private function getReport(Google_Service_AnalyticsReporting_ReportRequest $google_request): Google_Service_AnalyticsReporting_GetReportsResponse
    {
        $report = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $report->setReportRequests([$google_request]);

        return $this->analytics->reports->batchGet($report);
    }

    /**
     * @param Google_Service_AnalyticsReporting_GetReportsResponse $reports
     */
    private function parseDados(Google_Service_AnalyticsReporting_GetReportsResponse $reports): void
    {
        for ($reportIndex = 0; $reportIndex < count($reports); $reportIndex++) {
            $report = $reports[$reportIndex];
            $header = $report->getColumnHeader();
            $dimensionHeaders = $header->getDimensions();
            $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
            $rows = $report->getData()->getRows();

            for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                $row = $rows[$rowIndex];
                $dimensions = $row->getDimensions();
                $metrics = $row->getMetrics();
                for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
                    $this->dados[$dimensionHeaders[$i]] = $dimensions[$i];
                }

                for ($j = 0; $j < count($metrics); $j++) {
                    $values = $metrics[$j]->getValues();
                    for ($k = 0; $k < count($values); $k++) {
                        $entry = $metricHeaders[$k];
                        $this->dados[$entry->getName()] = $values[$k];
                    }
                }
            }
        }
    }

    /**
     * Buscar os dados no serviço de analytics
     * @throws Google_Exception
     */
    public function buscarDados()
    {
        if (is_null($this->analytics)) {
            $this->conectar();
        }

        $request = $this->gerarRequest();
        $response = $this->getReport($request);

        $this->parseDados($response);
    }
}