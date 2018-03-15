<?php
/**
 * website-dlx
 * @version: v1.17.11
 * @author: Diego Lepera
 *
 * Created by Diego Lepera on 2017-11-23. Please report any bug at
 * https://github.com/dlepera88-php/website-dlx/issues
 *
 * The MIT License (MIT)
 * Copyright (c) 2017 Diego Lepera http://diegolepera.xyz/
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

$__APLICATIVO = 'PainelDLX';
$__MODULO = 'Website';

// Configurações ------------------------------------------------------------ //
\DLX::$dlx->adicionarRota('^%home%website/configuracoes/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'Configuracoes',
    'acao'       => 'mostrarDetalhes'
]);

\DLX::$dlx->adicionarRota('^%home%website/configuracoes/editar/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'Configuracoes',
    'acao'       => 'mostrarForm'
]);

\DLX::$dlx->adicionarRota('^%home%website/configuracoes/salvar$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'Configuracoes',
    'acao'       => 'salvar'
], 'post');


// Assuntos de contatos ----------------------------------------------------- //
\DLX::$dlx->adicionarRota('^%home%website/assuntos-de-contato/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'AssuntoContato',
    'acao'       => 'mostrarLista'
]);

\DLX::$dlx->adicionarRota('^%home%website/assuntos-de-contato/novo/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'AssuntoContato',
    'acao'       => 'mostrarForm'
]);

\DLX::$dlx->adicionarRota('^%home%website/assuntos-de-contato/editar/\d+/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'AssuntoContato',
    'acao'       => 'mostrarForm',
    'params'     => '/-/-/-/:pk'
]);

\DLX::$dlx->adicionarRota('^%home%website/assuntos-de-contato/mostrar-detalhes/\d+/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'AssuntoContato',
    'acao'       => 'mostrarDetalhes',
    'params'     => '/-/-/-/:pk'
]);

\DLX::$dlx->adicionarRota('^%home%website/assuntos-de-contato/inserir$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'AssuntoContato',
    'acao'       => 'salvar'
], 'post');

\DLX::$dlx->adicionarRota('^%home%website/assuntos-de-contato/salvar$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'AssuntoContato',
    'acao'       => 'salvar'
], 'post');

\DLX::$dlx->adicionarRota('^%home%website/assuntos-de-contato/excluir$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'AssuntoContato',
    'acao'       => 'excluir'
], 'post');


// Contatos recebidos ------------------------------------------------------- //
\DLX::$dlx->adicionarRota('^%home%website/contatos-recebidos/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'Contato',
    'acao'       => 'mostrarLista'
]);

\DLX::$dlx->adicionarRota('^%home%website/contatos-recebidos/mostrar-detalhes/\d+?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'Contato',
    'acao'       => 'mostrarDetalhes',
    'params'     => '/-/-/-/:pk'
]);

\DLX::$dlx->adicionarRota('^%home%website/contatos-recebidos/excluir$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'Contato',
    'acao'       => 'excluir'
], 'post');

// Tipos de informações de contato ------------------------------------------------------------- //
\DLX::$dlx->adicionarRota('^%home%website/tipos-de-informacoes/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'TipoInfo',
    'acao'       => 'mostrarLista'
]);

\DLX::$dlx->adicionarRota('^%home%website/tipos-de-informacoes/novo/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'TipoInfo',
    'acao'       => 'mostrarForm'
]);

\DLX::$dlx->adicionarRota('^%home%website/tipos-de-informacoes/editar/\d+/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'TipoInfo',
    'acao'       => 'mostrarForm',
    'params'     => '/-/-/-/:pk'
]);

\DLX::$dlx->adicionarRota('^%home%website/tipos-de-informacoes/mostrar-detalhes/\d+/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'TipoInfo',
    'acao'       => 'mostrarDetalhes',
    'params'     => '/-/-/-/:pk'
]);

\DLX::$dlx->adicionarRota('^%home%website/tipos-de-informacoes/inserir$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'TipoInfo',
    'acao'       => 'inserir'
], 'post');

\DLX::$dlx->adicionarRota('^%home%website/tipos-de-informacoes/salvar$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'TipoInfo',
    'acao'       => 'salvar'
], 'post');

\DLX::$dlx->adicionarRota('^%home%website/tipos-de-informacoes/excluir$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'TipoInfo',
    'acao'       => 'excluir'
], 'post');

\DLX::$dlx->adicionarRota('^%home%website/tipos-de-informacoes/obter-configuracoes/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'TipoInfo',
    'acao'       => 'configuracoes',
    'params'     => ['tipo' => filter_input(INPUT_GET, 'tipo', FILTER_VALIDATE_INT)]
]);

// Informações de contato ---------------------------------------------------------------------- //
\DLX::$dlx->adicionarRota('^%home%website/informacoes-de-contato/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'InfoContato',
    'acao'       => 'mostrarLista'
]);

\DLX::$dlx->adicionarRota('^%home%website/informacoes-de-contato/novo/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'InfoContato',
    'acao'       => 'mostrarForm'
]);

\DLX::$dlx->adicionarRota('^%home%website/informacoes-de-contato/editar/\d+/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'InfoContato',
    'acao'       => 'mostrarForm',
    'params'     => '/-/-/-/:pk'
]);

\DLX::$dlx->adicionarRota('^%home%website/informacoes-de-contato/mostrar-detalhes/\d+/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'InfoContato',
    'acao'       => 'mostrarDetalhes',
    'params'     => '/-/-/-/:pk'
]);

\DLX::$dlx->adicionarRota('^%home%website/informacoes-de-contato/inserir$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'InfoContato',
    'acao'       => 'inserir'
], 'post');

\DLX::$dlx->adicionarRota('^%home%website/informacoes-de-contato/salvar$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'InfoContato',
    'acao'       => 'salvar'
], 'post');

\DLX::$dlx->adicionarRota('^%home%website/informacoes-de-contato/excluir$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'InfoContato',
    'acao'       => 'excluir'
], 'post');