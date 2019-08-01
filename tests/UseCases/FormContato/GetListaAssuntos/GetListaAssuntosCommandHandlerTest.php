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

namespace Website\Tests\UseCases\FormContato\GetListaAssuntos;

use ReflectionException;
use ReflectionProperty;
use Website\Domain\FormContato\Entities\AssuntoContato;
use Website\Domain\FormContato\Repositories\AssuntoContatoRepositoryInterface;
use Website\Tests\TestCase\WebsiteTestCase;
use Website\UseCases\FormContato\GetListaAssuntos\GetListaAssuntosCommand;
use Website\UseCases\FormContato\GetListaAssuntos\GetListaAssuntosCommandHandler;

/**
 * Class GetListaAssuntosCommandHandlerTest
 * @package Website\Tests\UseCases\FormContato\GetListaAssuntos
 * @coversDefaultClass \Website\UseCases\FormContato\GetListaAssuntos\GetListaAssuntosCommandHandler
 */
class GetListaAssuntosCommandHandlerTest extends WebsiteTestCase
{
    /**
     * @return GetListaAssuntosCommandHandler
     * @throws ReflectionException
     */
    public function test__construct(): GetListaAssuntosCommandHandler
    {
        /** @var AssuntoContatoRepositoryInterface $assunto_contato_repository */
        $assunto_contato_repository = $this->createMock(AssuntoContatoRepositoryInterface::class);
        $handler = new GetListaAssuntosCommandHandler($assunto_contato_repository);

        $rfx_repository = new ReflectionProperty($handler, 'assunto_contato_repository');
        $rfx_repository->setAccessible(true);

        $this->assertInstanceOf(GetListaAssuntosCommandHandler::class, $handler);
        $this->assertEquals($assunto_contato_repository, $rfx_repository->getValue($handler));

        return $handler;
    }

    /**
     * @param GetListaAssuntosCommandHandler $handler
     * @covers ::handle
     */
    public function test_Handle_deve_retornar_apenas_registros_de_AssuntoContato_nao_deletados()
    {
        $assunto_contato = $this->getMockBuilder(AssuntoContato::class)
            ->setMethods(['isDeletado'])
            ->disableOriginalConstructor()
            ->getMock();
        $assunto_contato->method('isDeletado')->willReturn(false);

        $assunto_contato_deletado = $this->getMockBuilder(AssuntoContato::class)
            ->setMethods(['isDeletado'])
            ->disableOriginalConstructor()
            ->getMock();
        $assunto_contato_deletado->method('isDeletado')->willReturn(true);

        $assunto_contato_repository = $this->createMock(AssuntoContatoRepositoryInterface::class);
        $assunto_contato_repository->method('findByLike')->willReturn([
            $assunto_contato,
            $assunto_contato_deletado
        ]);

        /** @var AssuntoContatoRepositoryInterface $assunto_contato_repository */

        /** @var GetListaAssuntosCommand $command */
        $command = $this->createMock(GetListaAssuntosCommand::class);
        $handler = new GetListaAssuntosCommandHandler($assunto_contato_repository);
        $lista_assuntos = $handler->handle($command);

        $this->assertCount(1, $lista_assuntos);

        /** @var AssuntoContato $assunto_contato */
        foreach ($lista_assuntos as $assunto_contato) {
            $this->assertFalse($assunto_contato->isDeletado());
        }
    }
}
