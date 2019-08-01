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

namespace Website\Tests\UseCases\FormContato\GetListaContatosRecebidos;

use PHPUnit\Framework\TestCase;
use Website\Domain\FormContato\Entities\ContatoRecebido;
use Website\Domain\FormContato\Repositories\ContatoRecebidoRepositoryInterface;
use Website\UseCases\FormContato\GetListaContatosRecebidos\GetListaContatosRecebidosCommand;
use Website\UseCases\FormContato\GetListaContatosRecebidos\GetListaContatosRecebidosCommandHandler;

/**
 * Class GetListaContatosRecebidosCommandHandlerTest
 * @package Website\Tests\UseCases\FormContato\GetListaContatosRecebidos
 * @coversDefaultClass \Website\UseCases\FormContato\GetListaContatosRecebidos\GetListaContatosRecebidosCommandHandler
 */
class GetListaContatosRecebidosCommandHandlerTest extends TestCase
{
    /**
     * @return GetListaContatosRecebidosCommandHandler
     */
    public function test__construct(): GetListaContatosRecebidosCommandHandler
    {
        /** @var ContatoRecebidoRepositoryInterface $contato_recebido_repository */
        $contato_recebido_repository = $this->createMock(ContatoRecebidoRepositoryInterface::class);

        $handler = new GetListaContatosRecebidosCommandHandler($contato_recebido_repository);

        $this->assertInstanceOf(GetListaContatosRecebidosCommandHandler::class, $handler);

        return $handler;
    }

    /**
     *
     */
    public function test_Handle_deve_retornar_apenas_ContatoRecebido_nao_deletados()
    {
        $contato_recebido_deletado = $this->getMockBuilder(ContatoRecebido::class)
            ->setMethods(['isDeletado'])
            ->getMock();
        $contato_recebido_deletado->method('isDeletado')->willReturn(true);


        $contato_recebido = $this->getMockBuilder(ContatoRecebido::class)
            ->setMethods(['isDeletado'])
            ->getMock();
        $contato_recebido->method('isDeletado')->willReturn(false);

        $contato_recebido_repository = $this->createMock(ContatoRecebidoRepositoryInterface::class);
        $contato_recebido_repository->method('findByLike')->willReturn([
            $contato_recebido,
            $contato_recebido_deletado
        ]);

        $command = $this->createMock(GetListaContatosRecebidosCommand::class);

        /** @var ContatoRecebidoRepositoryInterface $contato_recebido_repository */
        /** @var GetListaContatosRecebidosCommand $command */

        $handler = new GetListaContatosRecebidosCommandHandler($contato_recebido_repository);
        $lista_contatos_recebidos = $handler->handle($command);

        $this->assertCount(1, $lista_contatos_recebidos);

        /** @var ContatoRecebido $contato_recebido */
        foreach ($lista_contatos_recebidos as $contato_recebido) {
            $this->assertFalse($contato_recebido->isDeletado());
        }
    }
}
