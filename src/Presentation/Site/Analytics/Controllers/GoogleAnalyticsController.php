<?php

use Website\UseCases\Analytics\GetDadosAcesso\GetDadosAcessoCommandHandler;

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

namespace Website\Presentation\Site\Analytics\Controllers;


use DateTime;
use Exception;
use Google_Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Website\Presentation\Site\Common\Controllers\SiteController;
use Website\UseCases\Analytics\GetDadosAcesso\GetDadosAcessoCommand;
use Zend\Diactoros\Response\JsonResponse;

class GoogleAnalyticsController extends SiteController
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function getDadosAcesso(ServerRequestInterface $request): ResponseInterface
    {
        $get = filter_var_array($request->getQueryParams(), [
            'id' => FILTER_SANITIZE_NUMBER_INT,
            'data_inicial' => FILTER_DEFAULT,
            'data_final' => FILTER_DEFAULT
        ]);

        try {
            $data_inicial = new DateTime($get['data_inicial']);
            $data_final = new DateTime($get['data_final']);

            /** @var array $dados_acesso */
            /* @see GetDadosAcessoCommandHandler */
            $dados_acesso = $this->command_bus->handle(new GetDadosAcessoCommand(
                $get['id'],
                $data_inicial,
                $data_final,
                ['sessions']
            ));

            $json['retorno'] = 'sucesso';
            $json['dados_acesso'] = $dados_acesso;
        } catch (Google_Exception $e) {
            $json['retorno'] = 'erro';
            $json['mensagem'] = $e->getMessage();
        }

        return new JsonResponse($json);
    }
}