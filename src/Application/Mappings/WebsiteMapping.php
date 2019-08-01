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

namespace Website\Application\Mappings;


use Website\UseCases\Analytics\GetDadosAcesso\GetDadosAcessoCommand;
use Website\UseCases\Analytics\GetDadosAcesso\GetDadosAcessoCommandHandler;
use Website\UseCases\FormContato\GetAssuntoPorId\GetAssuntoContatoPorIdCommand;
use Website\UseCases\FormContato\GetAssuntoPorId\GetAssuntoContatoPorIdCommandHandler;
use Website\UseCases\FormContato\GetContatoRecebidoPorId\GetContatoRecebidoPorIdCommand;
use Website\UseCases\FormContato\GetContatoRecebidoPorId\GetContatoRecebidoPorIdCommandHandler;
use Website\UseCases\FormContato\GetListaAssuntos\GetListaAssuntosCommand;
use Website\UseCases\FormContato\GetListaAssuntos\GetListaAssuntosCommandHandler;
use Website\UseCases\FormContato\GetListaContatosRecebidos\GetListaContatosRecebidosCommand;
use Website\UseCases\FormContato\GetListaContatosRecebidos\GetListaContatosRecebidosCommandHandler;
use Website\UseCases\FormContato\SalvarContatoSite\SalvarContatoSiteCommand;
use Website\UseCases\FormContato\SalvarContatoSite\SalvarContatoSiteCommandHandler;

class WebsiteMapping
{
    private $mapping = [
        GetDadosAcessoCommand::class => GetDadosAcessoCommandHandler::class,

        // FormContato
        GetContatoRecebidoPorIdCommand::class => GetContatoRecebidoPorIdCommandHandler::class,
        GetListaContatosRecebidosCommand::class => GetListaContatosRecebidosCommandHandler::class,
        SalvarContatoSiteCommand::class => SalvarContatoSiteCommandHandler::class,
        GetListaAssuntosCommand::class => GetListaAssuntosCommandHandler::class,
        GetAssuntoContatoPorIdCommand::class => GetAssuntoContatoPorIdCommandHandler::class,
    ];

    /**
     * @return array
     */
    public function getMapping(): array
    {
        return $this->mapping;
    }
}