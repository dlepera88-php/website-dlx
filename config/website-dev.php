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

use DLX\Core\Configure;
use Doctrine\DBAL\Logging\EchoSQLLogger;
use PainelDLX\Application\Services\PainelDLX;

// ini_set('session.save_handler', 'files');

$dir_painel_dlx = !empty(PainelDLX::$dir) ? PainelDLX::$dir . DIRECTORY_SEPARATOR : '';

return [
    'tipo-ambiente' => Configure::DEV,

    'app' => [
        'nome' => 'website-dlx',
        'nome-amigavel' => 'Website',
        'base-html' => '/',
        'base-url' => 'http://website-dlx.localhost/',
        'rotas' => include 'rotas.php',
        'service-providers' => include 'website/service_providers.php',
        'mapping' => include 'website/mapping.php',
        'favicon' => PainelDLX::$dir . '/public/imgs/favicon.png',
        'versao' => '2.0'
    ],

    'bd' => [
        'orm' => 'doctrine',
        'mapping' => 'yaml',
        'dev-mode' => true,
        //'debug' => EchoSQLLogger::class,
        'dir' => [
            'src/Infra/ORM/Doctrine/Mappings',
            'src/Infra/ORM/Doctrine/Repositories',

            "{$dir_painel_dlx}src/Infra/ORM/Doctrine/Mappings",
            "{$dir_painel_dlx}src/Infra/ORM/Doctrine/Repositories"
        ],
        'conexao' => [
            'dbname' => 'dlx_dev',
            'user' => 'root',
            'password' => '$d5Ro0t',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ]
    ]
];