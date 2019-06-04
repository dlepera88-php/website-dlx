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


use DateTime;

abstract class AbstractAnalytics
{
    /** @var string */
    private $view_id;
    /** @var DateTime */
    private $data_inicial;
    /** @var DateTime */
    private $data_final;
    /** @var string[] */
    private $metricas = [];
    /** @var array */
    protected $dados = [];

    /**
     * @return string
     */
    public function getViewId(): string
    {
        return $this->view_id;
    }

    /**
     * @param string $view_id
     * @return AbstractAnalytics
     */
    public function setViewId(string $view_id): AbstractAnalytics
    {
        $this->view_id = $view_id;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataInicial(): DateTime
    {
        return $this->data_inicial;
    }

    /**
     * @param DateTime $data_inicial
     * @return AbstractAnalytics
     */
    public function setDataInicial(DateTime $data_inicial): AbstractAnalytics
    {
        $this->data_inicial = $data_inicial;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataFinal(): DateTime
    {
        return $this->data_final;
    }

    /**
     * @param DateTime $data_final
     * @return AbstractAnalytics
     */
    public function setDataFinal(DateTime $data_final): AbstractAnalytics
    {
        $this->data_final = $data_final;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getMetricas(): array
    {
        return $this->metricas;
    }

    /**
     * @param string[] $metricas
     * @return AbstractAnalytics
     */
    public function setMetricas(array $metricas): AbstractAnalytics
    {
        $this->metricas = $metricas;
        return $this;
    }

    /**
     * @return array
     */
    public function getDados(): array
    {
        return $this->dados;
    }

    /**
     * Setar todos os parâmetros necessários para gerar o relatório
     * @param string $id_vista
     * @param DateTime $data_inicial
     * @param DateTime $data_final
     * @param string ...$metricas
     */
    public function setParametrosRelatorio(
        string $id,
        DateTime $data_inicial,
        DateTime $data_final,
        string ... $metricas
    ) {
        $this->setViewId($id);
        $this->setDataInicial($data_inicial);
        $this->setDataFinal($data_final);
        $this->setMetricas($metricas);
    }
}