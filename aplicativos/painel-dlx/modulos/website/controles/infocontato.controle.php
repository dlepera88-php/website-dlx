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
use DLX\Ajudantes\Vetores;
use Geral\Controles\PainelDLX;
use Geral\Controles\RegistroConsulta;
use Geral\Controles\RegistroEdicao;
use PainelDLX\Website\Modelos\TipoInfo;

class InfoContato extends PainelDLX {
    use RegistroConsulta, RegistroEdicao;

    public function __construct() {
        parent::__construct(dirname(__DIR__), new \PainelDLX\Website\Modelos\InfoContato(), 'website/informacoes-de-contato');

        $this->adicionarEvento('depois', 'mostrarDetalhes', function () {
            # Visão
            $this->visao->adicionarTemplate('det_info_contato');

            # JS
            $this->visao->adicionarJS('web/js/jquery-mostrar-msg/jquery.mostrarmsg.plugin-min.js');

            # Parâmetros
            $this->visao->tituloPagina($this->modelo->getValor());

            $this->visao->mostrarConteudo();
        });
    } // Fim do método __construct


    /**
     * Mostrar a lista de registro
     * @return void
     */
    protected function mostrarLista() {
        $this->gerarLista(
            sprintf(AjdConstrutorSQL::SQL_CAMPO_COM_ALIAS, 'info_contato_id', $this->visao->traduzir('ID', 'painel-dlx')) . ',' .
            sprintf(AjdConstrutorSQL::SQL_CAMPO_COM_ALIAS, 'tipo_info_nome', $this->visao->traduzir('Tipo', 'website-dlx')) . ',' .
            sprintf(AjdConstrutorSQL::SQL_CAMPO_COM_ALIAS, "CASE WHEN info_contato_valor <> info_contato_exibicao THEN CONCAT(CONCAT(COALESCE(tipo_info_prefixo, ''), info_contato_valor), '<br>', info_contato_exibicao) ELSE info_contato_exibicao END", $this->visao->traduzir('Informação', 'website-dlx')) . ',' .
            sprintf(AjdConstrutorSQL::SQL_CASE_SIM_NAO, 'tipo_info_rede_social', $this->visao->traduzir('Rede Social?', 'website-dlx')) . ',' .
            sprintf(AjdConstrutorSQL::SQL_CASE_SIM_NAO, 'info_contato_publicar', $this->visao->traduzir('Ativo?', 'painel-dlx')),
            ['order_by' => 'tipo_info_rede_social, tipo_info_nome, info_contato_valor']
        );

        # Visão
        $this->visao->adicionarTemplate('comum/visoes/menu_opcoes');
        $this->visao->adicionarTemplate('comum/visoes/form_filtro');
        $this->visao->adicionarTemplate('comum/visoes/lista');

        # JS
        $this->visao->adicionarJS('web/js/jquery-mostrar-msg/jquery.mostrarmsg.plugin-min.js');

        # Parâmetros
        $this->visao->tituloPagina($this->visao->traduzir('Informações de contato', 'painel-dlx'));
        $this->visao->adicionarParam('html:form-acao', $this->url_excluir);

        $this->visao->mostrarConteudo();
    } // Fim do método mostrarLista


    /**
     * Mostrar formulário de inclusão / edição do registro
     * @param  int $pk PK identificadora do registro. Quando não informada, o
     * formulário considerará que um novo registro será incluído.
     * @return void
     */
    protected function mostrarForm($pk = null) {
        $this->gerarForm('info-contato', 'website/informacoes-de-contato/inserir', 'website/informacoes-de-contato/salvar', $pk);

        # Tipos de informações
        $tipo_info = new TipoInfo($this->modelo->getTipo());

        # Visão
        $this->visao->adicionarTemplate('comum/visoes/menu_opcoes');
        $this->visao->adicionarTemplate('form_info_contato');
        $this->visao->adicionarTemplate('comum/visoes/form_ajax');

        # JS
        $this->visao->adicionarJS('web/js/jquery-form-ajax/jquery.formajax.plugin-min.js');
        $this->visao->adicionarJS('web/js/jquery-mostrar-msg/jquery.mostrarmsg.plugin.js');
        $this->visao->adicionarJS('web/js/jquery-mascara/jquery.mascara.plugin.js');

        # Parâmetros
        $this->visao->adicionarParam('modelo:tipo-info', $tipo_info);
        $this->visao->adicionarParam('lista:tipos-infos',
            Vetores::coluna2Chave(
                $tipo_info->listar((object)[
                    'where' => 'tipo_info_publicar = 1',
                    'order_by' => 'tipo_info_nome'
                ], 'tipo_info_id, tipo_info_nome, tipo_info_rede_social'),
                'tipo_info_rede_social'
            )
        );

        $this->visao->mostrarConteudo();
    } // Fim do método mostrarForm
}// Fim do controle InfoContato
