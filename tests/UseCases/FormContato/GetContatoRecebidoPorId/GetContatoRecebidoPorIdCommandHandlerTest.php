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

namespace Website\Tests\UseCases\FormContato\GetContatoRecebidoPorId;

use DLX\Infrastructure\EntityManagerX;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\ORMException;
use Website\Domain\Contato\Entities\ContatoRecebido;
use Website\Domain\Contato\Repositories\ContatoRecebidoRepositoryInterface;
use Website\Tests\TestCase\WebsiteTestCase;
use Website\UseCases\Contato\GetContatoRecebidoPorId\GetContatoRecebidoPorIdCommand;
use Website\UseCases\Contato\GetContatoRecebidoPorId\GetContatoRecebidoPorIdCommandHandler;

/**
 * Class GetContatoRecebidoPorIdCommandHandlerTest
 * @package Website\Tests\UseCases\FormContato\GetContatoRecebidoPorId
 * @coversDefaultClass \Website\UseCases\Contato\GetContatoRecebidoPorId\GetContatoRecebidoPorIdCommandHandler
 */
class GetContatoRecebidoPorIdCommandHandlerTest extends WebsiteTestCase
{

    /**
     * @return GetContatoRecebidoPorIdCommandHandler
     * @throws ORMException
     */
    public function test__construct(): GetContatoRecebidoPorIdCommandHandler
    {
        /** @var ContatoRecebidoRepositoryInterface $contato_recebido_repository */
        $contato_recebido_repository = EntityManagerX::getRepository(ContatoRecebido::class);

        $handler = new GetContatoRecebidoPorIdCommandHandler($contato_recebido_repository);

        $this->assertInstanceOf(GetContatoRecebidoPorIdCommandHandler::class, $handler);

        return $handler;
    }

    /**
     * @param GetContatoRecebidoPorIdCommandHandler $handler
     * @covers ::handle
     * @depends test__construct
     */
    public function test_Handle_deve_retornar_null_quando_nao_encontrar_registro_no_bd(GetContatoRecebidoPorIdCommandHandler $handler)
    {
        $command = new GetContatoRecebidoPorIdCommand(0);
        $contato_recebido = $handler->handle($command);

        $this->assertNull($contato_recebido);
    }

    /**
     * @param GetContatoRecebidoPorIdCommandHandler $handler
     * @covers ::handle
     * @depends test__construct
     * @throws DBALException
     * @throws ORMException
     */
    public function test_Handle_deve_retornar_ContatoRecebido_quando_encontrar_registro_no_bd(GetContatoRecebidoPorIdCommandHandler $handler)
    {
        $query = '
            select
                contato_recebido_id
            from
                dlx_contatos_recebidos
            where 
                rand()
            limit 1
        ';

        $sql = EntityManagerX::getInstance()->getConnection()->executeQuery($query);
        $id = $sql->fetchColumn();

        $command = new GetContatoRecebidoPorIdCommand($id);
        $contato_recebido = $handler->handle($command);

        $this->assertInstanceOf(ContatoRecebido::class, $contato_recebido);
        $this->assertEquals($id, $contato_recebido->getId());
    }
}
