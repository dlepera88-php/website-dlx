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

namespace Website\Presentation\PainelDLX\Contato;


use DLX\Core\Exceptions\UserException;
use PainelDLX\Presentation\Site\Common\Controllers\PainelDLXController;
use PainelDLX\UseCases\ListaRegistros\ConverterFiltro2Criteria\ConverterFiltro2CriteriaCommand;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vilex\Exceptions\ContextoInvalidoException;
use Vilex\Exceptions\PaginaMestraNaoEncontradaException;
use Vilex\Exceptions\ViewNaoEncontradaException;
use Website\UseCases\Contato\ListaContatosRecebidos\ListaContatosRecebidosCommand;

/**
 * Class ListaContatosRecebidosController
 * @package Website\Presentation\PainelDLX\Contato
 * @covers ListaContatosRecebidosControllerTest
 */
class ListaContatosRecebidosController extends PainelDLXController
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws PaginaMestraNaoEncontradaException
     * @throws ContextoInvalidoException
     * @throws ViewNaoEncontradaException
     */
    public function listaContatosRecebidos(ServerRequestInterface $request): ResponseInterface
    {
        $get = filter_var_array($request->getQueryParams(), [
            'campos' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
            'busca' => FILTER_DEFAULT,
            'pg' => FILTER_VALIDATE_INT,
            'qtde' => FILTER_VALIDATE_INT,
            'offset' => FILTER_VALIDATE_INT
        ]);

        try {
            /** @var array $criteria */
            /* @see ConverterFiltro2CriteriaCommandHandler */
            $criteria = $this->command_bus->handle(new ConverterFiltro2CriteriaCommand($get['campos'], $get['busca']));

            /** @var array $lista_contatos */
            /* @see ListaContatosRecebidosCommandHandler */
            $lista_contatos = $this->command_bus->handle(new ListaContatosRecebidosCommand(
                $criteria,
                [],
                $get['qtde'],
                $get['offset']
            ));

            // Views
            $this->view->addTemplate('painel-dlx/contato/lista_contatos');
            $this->view->addTemplate('common/paginacao');

            // Parâmetros
            $this->view->setAtributo('titulo-pagina', 'Contatos recebidos');
            $this->view->setAtributo('lista-contatos', $lista_contatos);
            $this->view->setAtributo('filtro', $get);

            // Paginação
            $this->view->setAtributo('pagina-atual', $get['pg']);
            $this->view->setAtributo('qtde-registros-pagina', $get['qtde']);
            $this->view->setAtributo('qtde-registros-lista', count($lista_contatos));
        } catch (UserException $e) {
            $this->view->addTemplate('common/mensagem_usuario');
            $this->view->setAtributo('mensagem', [
                'tipo' => 'erro',
                'texto' => $e->getMessage()
            ]);
        }

        return $this->view->render();
    }
}