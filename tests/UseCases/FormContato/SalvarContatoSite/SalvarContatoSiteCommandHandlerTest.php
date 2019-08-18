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

namespace Website\Tests\UseCases\FormContato\SalvarContatoSite;

use DLX\Infrastructure\EntityManagerX;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\ORMException;
use Website\Domain\Contato\Entities\ContatoRecebido;
use Website\Domain\Contato\Repositories\ContatoRecebidoRepositoryInterface;
use Website\Tests\TestCase\WebsiteTestCase;
use Website\UseCases\Contato\SalvarContatoSite\SalvarContatoSiteCommand;
use Website\UseCases\Contato\SalvarContatoSite\SalvarContatoSiteCommandHandler;

/**
 * Class SalvarContatoSiteCommandHandlerTest
 * @package Website\Tests\UseCases\FormContato\SalvarContatoSite
 * @coversDefaultClass \Website\UseCases\Contato\SalvarContatoSite\SalvarContatoSiteCommandHandler
 */
class SalvarContatoSiteCommandHandlerTest extends WebsiteTestCase
{

    /**
     * @return SalvarContatoSiteCommandHandler
     * @throws ORMException
     */
    public function test__construct(): SalvarContatoSiteCommandHandler
    {
        /** @var ContatoRecebidoRepositoryInterface $contato_recebido_repository */
        $contato_recebido_repository = EntityManagerX::getRepository(ContatoRecebido::class);

        $handler = new SalvarContatoSiteCommandHandler($contato_recebido_repository);

        $this->assertInstanceOf(SalvarContatoSiteCommandHandler::class, $handler);

        return $handler;
    }

    /**
     * @param SalvarContatoSiteCommandHandler $handler
     * @covers ::handle
     * @depends test__construct
     * @throws DBALException
     * @throws ORMException
     */
    public function test_Handle_deve_salvar_registro_ContatoRecebido_no_bd(SalvarContatoSiteCommandHandler $handler)
    {
        $nome = 'Teste Unitário';
        $email = 'teste@teste.com.br';
        $telefone = '(61) 9 8350-3517';
        $mensagem = '';

        $command = new SalvarContatoSiteCommand(null, $nome, $email, $telefone, $mensagem);
        $contato_recebido = $handler->handle($command);

        $this->assertInstanceOf(ContatoRecebido::class, $contato_recebido);
        $this->assertNotNull($contato_recebido->getId());

        $query = 'select * from dlx_contatos_recebidos where contato_recebido_id = :contato_recebido_id';

        $sql = EntityManagerX::getInstance()->getConnection()->prepare($query);
        $sql->bindValue(':contato_recebido_id', $contato_recebido->getId(), ParameterType::INTEGER);
        $sql->execute();

        $this->assertEquals(1, $sql->rowCount());
    }
}
