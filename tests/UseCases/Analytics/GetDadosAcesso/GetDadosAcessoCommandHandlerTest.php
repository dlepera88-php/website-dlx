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

namespace Website\Tests\UseCases\Analytics\GetDadosAcesso;

use DateTime;
use Exception;
use Google_Exception;
use ReflectionException;
use ReflectionProperty;
use Website\Application\Services\Adapters\Analytics\GoogleAnalyticsAdapter;
use Website\Tests\TestCase\WebsiteTestCase;
use Website\UseCases\Analytics\GetDadosAcesso\GetDadosAcessoCommand;
use Website\UseCases\Analytics\GetDadosAcesso\GetDadosAcessoCommandHandler;

/**
 * Class GetDadosAcessoCommandHandlerTest
 * @package Website\Tests\UseCases\Analytics\GetDadosAcesso
 * @coversDefaultClass \Website\UseCases\Analytics\GetDadosAcesso\GetDadosAcessoCommandHandler
 */
class GetDadosAcessoCommandHandlerTest extends WebsiteTestCase
{
    /**
     * @return GetDadosAcessoCommandHandler
     * @throws ReflectionException
     */
    public function test__construct(): GetDadosAcessoCommandHandler
    {
        // todo: criar uma conta de teste no analytics

        $json_key = __DIR__ . '/../../../Helpers/arquivos/teste-analytics.json';
        $google_analytics_adapter = new GoogleAnalyticsAdapter(
            $json_key,
            'Barasíla Apart Hotéis'
        );

        $handler = new GetDadosAcessoCommandHandler($google_analytics_adapter);

        $rfx_analytics_adapter = new ReflectionProperty($handler, 'analytics_adapter');
        $rfx_analytics_adapter->setAccessible(true);

        $this->assertInstanceOf(GetDadosAcessoCommandHandler::class, $handler);
        $this->assertEquals($google_analytics_adapter, $rfx_analytics_adapter->getValue($handler));

        return $handler;
    }

    /**
     * @param GetDadosAcessoCommandHandler $handler
     * @covers ::handle
     * @depends test__construct
     */
    public function test_Handle_deve_retornar_array_de_acordo_com_metricas(GetDadosAcessoCommandHandler $handler)
    {
        $data_inicial = new DateTime('7 days ago');
        $data_final = new DateTime();
        $metricas = ['sessions'];

        $command = new GetDadosAcessoCommand(
            '194964858',
            $data_inicial,
            $data_final,
            $metricas
        );

        $dados_acesso = $handler->handle($command);

        $this->assertIsArray($dados_acesso);
        $this->assertCount(count($metricas), $dados_acesso);
    }

    /**
     * @param GetDadosAcessoCommandHandler $handler
     * @throws Exception
     * @covers ::handle
     * @depends test__construct
     */
    public function test_Handle_deve_lancar_Google_Exception_quando_parametros_incorretos(GetDadosAcessoCommandHandler $handler)
    {
        $data_inicial = new DateTime('7 days ago');
        $data_final = new DateTime();
        $metricas = ['sessions'];

        $command = new GetDadosAcessoCommand(
            '0000000000',
            $data_inicial,
            $data_final,
            $metricas
        );

        $this->expectException(Google_Exception::class);

        $handler->handle($command);
    }
}
