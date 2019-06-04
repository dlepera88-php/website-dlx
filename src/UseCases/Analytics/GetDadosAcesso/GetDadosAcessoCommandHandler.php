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

namespace Website\UseCases\Analytics\GetDadosAcesso;


use Website\Domain\Common\Services\Adapters\AnalyticsAdapterInterface;

class GetDadosAcessoCommandHandler
{
    /**
     * @var AnalyticsAdapterInterface
     */
    private $analytics_adapter;

    public function __construct(AnalyticsAdapterInterface $analytics_adapter)
    {
        $this->analytics_adapter = $analytics_adapter;
    }

    /**
     * @param GetDadosAcessoCommand $command
     * @return array
     */
    public function handle(GetDadosAcessoCommand $command): array
    {
        $this->analytics_adapter->setParametrosRelatorio(
            $command->getId(),
            $command->getDataInicial(),
            $command->getDataFinal(),
            ... $command->getMetricas()
        );

        $this->analytics_adapter->buscarDados();

        return $this->analytics_adapter->getDados();
    }
}