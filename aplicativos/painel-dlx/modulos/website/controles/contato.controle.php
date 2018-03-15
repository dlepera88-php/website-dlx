<?php
/**
 * website-dlx
 * @version: v1.17.08
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

namespace PainelDLX\Website\Controles;

use DLX\Ajudantes\ConstrutorSQL as AjdConstrutorSQL;
use Geral\Controles\PainelDLX;
use Geral\Controles\RegistroConsulta;
use Geral\Controles\RegistroEdicao;
use PainelDLX\Website\Modelos\AssuntoContato;

class Contato extends PainelDLX {
    use RegistroConsulta, RegistroEdicao;

    public function __construct() {
        parent::__construct(dirname(__DIR__), new \PainelDLX\Website\Modelos\Contato(), 'website/contatos-recebidos');

        $this->adicionarEvento('depois', 'mostrarDetalhes', function () {
            # Visão
            $this->visao->adicionarTemplate('det_contato');

            # JS
            $this->visao->adicionarJS('web/js/jquery-mostrar-msg/jquery.mostrarmsg.plugin-min.js');
            
            # Parâmetros
            $this->visao->tituloPagina($this->modelo->getNome());
            $this->visao->adicionarParam('modelo:assunto', new AssuntoContato($this->modelo->getAssunto()));

            $this->visao->mostrarConteudo();
        });
    } // Fim do método __construct


    /**
     * Mostrar a lista de registro
     * @return void
     */
    protected function mostrarLista() {
        $this->gerarLista(
            sprintf(AjdConstrutorSQL::SQL_CAMPO_COM_ALIAS, 'contato_id', $this->visao->traduzir('ID', 'painel-dlx')) . ',' .
            sprintf(AjdConstrutorSQL::SQL_CAMPO_COM_ALIAS, "DATE_FORMAT(log_registro_data, '%d/%m/%Y')", $this->visao->traduzir('Data', 'website-dlx')) . ',' .
            sprintf(AjdConstrutorSQL::SQL_CAMPO_COM_ALIAS, "CONCAT('<span style=\"color:', assunto_contato_cor, '\">', assunto_contato_texto, '</span>')", $this->visao->traduzir('Assunto', 'website-dlx')) . ',' .
            sprintf(AjdConstrutorSQL::SQL_CAMPO_COM_ALIAS, 'contato_nome', $this->visao->traduzir('Nome', 'website-dlx')) . ',' .
            sprintf(AjdConstrutorSQL::SQL_CAMPO_COM_ALIAS, 'contato_email', $this->visao->traduzir('Email', 'website-dlx')),
            ['order_by' => 'contato_id DESC']
        );

        # Visão
        $this->visao->adicionarTemplate('comum/visoes/menu_opcoes');
        $this->visao->adicionarTemplate('comum/visoes/form_filtro');
        $this->visao->adicionarTemplate('comum/visoes/lista');

        # JS
        $this->visao->adicionarJS('web/js/jquery-mostrar-msg/jquery.mostrarmsg.plugin-min.js');

        # Parâmetros
        $this->visao->tituloPagina($this->visao->traduzir('Contatos recebidos', 'website-dlx'));
        $this->visao->adicionarParam('html:form-acao', $this->url_excluir);

        $this->visao->mostrarConteudo();
    } // Fim do método mostrarLista
}// Fim do controle Contato
