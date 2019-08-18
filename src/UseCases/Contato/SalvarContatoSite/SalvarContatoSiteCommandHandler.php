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

namespace Website\UseCases\Contato\SalvarContatoSite;


use Website\Domain\Contato\Entities\ContatoRecebido;
use Website\Domain\Contato\Repositories\ContatoRecebidoRepositoryInterface;

/**
 * Class SalvarContatoSiteCommandHandler
 * @package Website\UseCases\Contato\SalvarContatoSite
 * @covers SalvarContatoSiteCommandHandlerTest
 */
class SalvarContatoSiteCommandHandler
{
    /**
     * @var ContatoRecebidoRepositoryInterface
     */
    private $contato_recebido_repository;

    /**
     * SalvarContatoSiteCommandHandler constructor.
     * @param ContatoRecebidoRepositoryInterface $contato_recebido_repository
     */
    public function __construct(ContatoRecebidoRepositoryInterface $contato_recebido_repository)
    {
        $this->contato_recebido_repository = $contato_recebido_repository;
    }

    /**
     * @param SalvarContatoSiteCommand $command
     * @return ContatoRecebido
     */
    public function handle(SalvarContatoSiteCommand $command): ContatoRecebido
    {
        $contato_recebido = new ContatoRecebido();
        $contato_recebido->setAssunto($command->getAssuntoContato());
        $contato_recebido->setNome($command->getNome());
        $contato_recebido->setEmail($command->getEmail());
        $contato_recebido->setTelefone($command->getTelefone());
        $contato_recebido->setMensagem($command->getMensagem());

        $this->contato_recebido_repository->create($contato_recebido);

        return $contato_recebido;
    }
}