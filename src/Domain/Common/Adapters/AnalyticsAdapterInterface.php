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

namespace Website\Domain\Common\Adapters;


use DateTime;

interface AnalyticsAdapterInterface
{
    /**
     * Pega as informações que vieram do serviço de analytics
     * @return array
     */
    public function getDados(): array;

    /**
     * Seta todos os parâmetros necessários para gerar o relatório
     * @param string $id
     * @param DateTime $data_inicial
     * @param DateTime $data_final
     * @param string ...$metricas
     */
    public function setParametrosRelatorio(
        string $id,
        DateTime $data_inicial,
        DateTime $data_final,
        string ... $metricas
    );

    /**
     * Busca os dados no serviço de analytics
     */
    public function buscarDados();
}