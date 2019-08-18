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

namespace Website\Tests\Presentation\PainelDLX\Contato;

use PainelDLX\Tests\TestCase\PainelDLXTestCase;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Vilex\Exceptions\ContextoInvalidoException;
use Vilex\Exceptions\PaginaMestraNaoEncontradaException;
use Vilex\Exceptions\ViewNaoEncontradaException;
use Website\Presentation\PainelDLX\Contato\ListaContatosRecebidosController;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class ListaContatosRecebidosControllerTest
 * @package Website\Tests\Presentation\PainelDLX\Contato
 * @coversDefaultClass \Website\Presentation\PainelDLX\Contato\ListaContatosRecebidosController
 */
class ListaContatosRecebidosControllerTest extends PainelDLXTestCase
{
    /**
     * @throws ContextoInvalidoException
     * @throws PaginaMestraNaoEncontradaException
     * @throws ViewNaoEncontradaException
     * @covers ::listaContatosRecebidos
     */
    public function test_ListaContatosRecebidos_deve_retornar_um_HtmlResponse()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $request->method('getQueryParams')->willReturn([]);

        /** @var ServerRequestInterface $request */

        /** @var ListaContatosRecebidosController $controller */
        $controller = self::$painel_dlx->getContainer()->get(ListaContatosRecebidosController::class);
        $response = $controller->listaContatosRecebidos($request);

        $this->assertInstanceOf(HtmlResponse::class, $response);

    }
}
