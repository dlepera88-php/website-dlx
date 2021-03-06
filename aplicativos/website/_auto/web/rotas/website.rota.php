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

$__APLICATIVO = 'Website';
$__MODULO = 'Home';

// Página Inicial ----------------------------------------------------------- //
\DLX::$dlx->adicionarRota('^%home%/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'Home',
    'acao'       => 'paginaInicial'
]);

// Sobre --------------------------------------------------------------------------------------- //
$__MODULO = 'Sobre';
\DLX::$dlx->adicionarRota('^%home%sobre/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'Institucional',
    'acao'       => 'informacoesInstitucionais'
]);

// Contato ------------------------------------------------------------------------------------- //
$__MODULO = 'FaleConosco';

\DLX::$dlx->adicionarRota('^%home%fale-conosco/?$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'Contato',
    'acao'       => 'mostrarForm'
]);

\DLX::$dlx->adicionarRota('^%home%fale-conosco/enviar-contato$', [
    'aplicativo' => $__APLICATIVO,
    'modulo'     => $__MODULO,
    'controle'   => 'Contato',
    'acao'       => 'enviarContato'
], 'post');
