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

namespace Website\Tests\Application\Services\Adapters\Analytics;

use DateTime;
use Exception;
use Google_Exception;
use Google_Service_AnalyticsReporting;
use ReflectionException;
use ReflectionProperty;
use Website\Application\Services\Adapters\Analytics\GoogleAnalyticsAdapter;
use Website\Tests\TestCase\WebsiteTestCase;

/**
 * Class GoogleAnalyticsAdapterTest
 * @package Website\Application\Services\Adapters\Analytics
 * @coversDefaultClass \Website\Application\Services\Adapters\Analytics\GoogleAnalyticsAdapter
 */
class GoogleAnalyticsAdapterTest extends WebsiteTestCase
{
    /**
     * @return GoogleAnalyticsAdapter
     * @throws ReflectionException
     */
    public function test__construct(): GoogleAnalyticsAdapter
    {
        $json_key = __DIR__ . '/../../../../Helpers/arquivos/teste-analytics.json';
        $nome_app = 'Brasília Apart Hotéis';
        $adapter = new GoogleAnalyticsAdapter($json_key, $nome_app);

        $rfx_json_key = new ReflectionProperty($adapter, 'json_key');
        $rfx_nome_app = new ReflectionProperty($adapter, 'nome_app');

        $rfx_json_key->setAccessible(true);
        $rfx_nome_app->setAccessible(true);

        $this->assertInstanceOf(GoogleAnalyticsAdapter::class, $adapter);
        $this->assertEquals($json_key, $rfx_json_key->getValue($adapter));
        $this->assertEquals($nome_app, $rfx_nome_app->getValue($adapter));

        return $adapter;
    }

    /**
     * @param GoogleAnalyticsAdapter $adapter
     * @covers ::conectar
     * @depends test__construct
     * @throws ReflectionException
     * @throws Google_Exception
     */
    public function test_Conectar_deve_instanciar_Google_Service_AnalyticsReporting(GoogleAnalyticsAdapter $adapter)
    {
        $adapter->conectar();

        $rfx_analytics = new ReflectionProperty($adapter, 'analytics');
        $rfx_analytics->setAccessible(true);

        $this->assertInstanceOf(Google_Service_AnalyticsReporting::class, $rfx_analytics->getValue($adapter));
    }

    /**
     * @param GoogleAnalyticsAdapter $adapter
     * @throws Exception
     * @covers ::buscarDados
     * @depends test__construct
     */
    public function test_BuscarDados_deve_buscar_dados_no_servico_e_colocar_em_um_array(GoogleAnalyticsAdapter $adapter)
    {
        $data_inicial = new DateTime('-1 month');
        $data_final = new DateTime();

        $adapter->setParametrosRelatorio(
            '194964858',
            $data_inicial,
            $data_final,
            'sessions'
        );

        $adapter->buscarDados();

        $dados = $adapter->getDados();

        $this->assertIsArray($dados);
        $this->assertNotEmpty($dados);
    }
}
