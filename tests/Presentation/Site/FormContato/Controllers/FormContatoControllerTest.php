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

namespace Website\Tests\Presentation\Site\FormContato\Controllers;

use League\Container\Container;
use PainelDLX\Tests\TestCase\TesteComTransaction;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionException;
use ReflectionProperty;
use Vilex\Exceptions\ContextoInvalidoException;
use Vilex\Exceptions\PaginaMestraNaoEncontradaException;
use Vilex\Exceptions\ViewNaoEncontradaException;
use Website\Presentation\Site\FormContato\Controllers\FormContatoController;
use Website\Tests\TestCase\WebsiteTestCase;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class FormContatoControllerTest
 * @package Website\Tests\Presentation\Site\FormContato\Controllers
 * @coversDefaultClass \Website\Presentation\Site\FormContato\Controllers\FormContatoController
 */
class FormContatoControllerTest extends WebsiteTestCase
{
    use TesteComTransaction;

    /**
     * @return FormContatoController
     * @throws ReflectionException
     */
    public function createController(): FormContatoController
    {
        $painel_dlx = self::$painel_dlx;

        $rfx_container = new ReflectionProperty($painel_dlx, 'container');
        $rfx_container->setAccessible(true);

        /** @var Container $container */
        $container = $rfx_container->getValue($painel_dlx);

        return $container->get(FormContatoController::class);
    }

    /**
     * @throws ContextoInvalidoException
     * @throws PaginaMestraNaoEncontradaException
     * @throws ReflectionException
     * @throws ViewNaoEncontradaException
     * @covers ::formContato
     */
    public function test_FormContato_deve_retornar_um_HtmlResponse()
    {
        $request = $this->createMock(ServerRequestInterface::class);

        /** @var ServerRequestInterface $request */

        $controller = $this->createController();
        $response = $controller->formContato($request);

        $this->assertInstanceOf(HtmlResponse::class, $response);
    }

    /**
     * @throws ReflectionException
     * @covers ::enviarContato
     */
    public function test_EnviarContato_deve_retornar_uma_JsonResponse()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $request->method('getParsedBody')->willReturn([
            'assunto' => null,
            'nome' => 'Teste Unitário',
            'email' => 'teste@teste.com.br',
            'telefone' => '(61) 9 0000-0000',
            'mensagem' => 'Teste'
        ]);

        /** @var ServerRequestInterface $request */

        $controller = $this->createController();
        $response = $controller->enviarContato($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
