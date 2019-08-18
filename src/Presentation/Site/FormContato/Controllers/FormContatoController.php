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

namespace Website\Presentation\Site\FormContato\Controllers;


use DLX\Core\Exceptions\UserException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vilex\Exceptions\ContextoInvalidoException;
use Vilex\Exceptions\PaginaMestraNaoEncontradaException;
use Vilex\Exceptions\ViewNaoEncontradaException;
use Website\Domain\Contato\Entities\AssuntoContato;
use Website\Presentation\Site\Common\Controllers\SiteController;
use Website\UseCases\Contato\GetAssuntoPorId\GetAssuntoContatoPorIdCommand;
use Website\UseCases\Contato\GetListaAssuntos\GetListaAssuntosCommand;
use Website\UseCases\Contato\GetListaAssuntos\GetListaAssuntosCommandHandler;
use Website\UseCases\Contato\SalvarContatoSite\SalvarContatoSiteCommand;
use Website\UseCases\Contato\SalvarContatoSite\SalvarContatoSiteCommandHandler;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class FormContatoController
 * @package Website\Presentation\Site\FormContato\Controllers
 * @covers FormContatoControllerTest
 */
class FormContatoController extends SiteController
{
    /**
     * Formulário para contato
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws PaginaMestraNaoEncontradaException
     * @throws ContextoInvalidoException
     * @throws ViewNaoEncontradaException
     */
    public function formContato(ServerRequestInterface $request): ResponseInterface
    {
        try {
            /** @var array $lista_assuntos */
            /* @see GetListaAssuntosCommandHandler */
            $lista_assuntos = $this->command_bus->handle(new GetListaAssuntosCommand());

            // Parâmetros
            $this->view->setAtributo('titulo-pagina', 'Entre em contato');
            $this->view->setAtributo('lista-assuntos', $lista_assuntos);

            // Templates
            $this->view->addTemplate('form-contato/form_contato');

            // JS
            $this->view->addArquivoJS('vendor/dlepera88-jquery/jquery-form-ajax/jquery.formajax.plugin-min.js');
            $this->view->addArquivoJS('vendor/dlepera88-jquery/jquery-mascara/jquery.mascara.plugin-min.js');
        } catch (UserException $e) {
            $this->view->addTemplate('common/mensagem_usuario');
            $this->view->setAtributo('mensagem', [
                'tipo' => 'erro',
                'mensagem' => $e->getMessage()
            ]);
        }

        return $this->view->render();
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function enviarContato(ServerRequestInterface $request): ResponseInterface
    {
        $post = filter_var_array($request->getParsedBody(), [
            'assunto' => FILTER_VALIDATE_INT,
            'nome' => FILTER_SANITIZE_STRING,
            'email' => FILTER_VALIDATE_EMAIL,
            'telefone' => FILTER_DEFAULT,
            'mensagem' => FILTER_DEFAULT
        ]);

        try {
            /** @var AssuntoContato|null $assunto */
            /* @see GetAssuntoContatoPorIdCommandHandler */
            $assunto = $this->command_bus->handle(new GetAssuntoContatoPorIdCommand((int)$post['assunto']));

            /* @see SalvarContatoSiteCommandHandler */
            $this->command_bus->handle(new SalvarContatoSiteCommand(
                $assunto,
                $post['nome'],
                $post['email'],
                $post['telefone'],
                $post['mensagem']
            ));

            $json['retorno'] = 'sucesso';
            $json['mensagem'] = 'Obrigado por entrar em contato conosco!<br>Responderemos o mais breve possível.';
        } catch (UserException $e) {
            $json['retorno'] = 'erro';
            $json['mensagem'] = $e->getMessage();
        }

        return new JsonResponse($json);
    }
}