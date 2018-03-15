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

class TipoInfo extends PainelDLX {
    use RegistroConsulta, RegistroEdicao;

    public function __construct() {
        parent::__construct(dirname(__DIR__), new \PainelDLX\Website\Modelos\TipoInfo(), 'website/tipos-de-informacoes');

        $this->adicionarEvento('depois', 'mostrarDetalhes', function () {
            # Visão
            $this->visao->adicionarTemplate('det_tipo_info');

            # JS
            $this->visao->adicionarJS('web/js/jquery-mostrar-msg/jquery.mostrarmsg.plugin-min.js');

            # Parâmetros
            $this->visao->tituloPagina($this->modelo->getNome());

            $this->visao->mostrarConteudo();
        });
    } // Fim do método __construct


    /**
     * Mostrar a lista de registro
     * @return void
     */
    protected function mostrarLista() {
        $this->gerarLista(
            sprintf(AjdConstrutorSQL::SQL_CAMPO_COM_ALIAS, 'tipo_info_id', $this->visao->traduzir('ID', 'painel-dlx')) . ',' .
            sprintf(AjdConstrutorSQL::SQL_CAMPO_COM_ALIAS, "CONCAT(tipo_info_nome, '<br>', COALESCE(tipo_info_prefixo, ''))", $this->visao->traduzir('Tipo', 'website-dlx')) . ',' .
            sprintf(AjdConstrutorSQL::SQL_CASE_SIM_NAO, 'tipo_info_rede_social', $this->visao->traduzir('Rede Social?', 'website-dlx')) . ',' .
            sprintf(AjdConstrutorSQL::SQL_CASE_SIM_NAO, 'tipo_info_publicar', $this->visao->traduzir('Ativo?', 'painel-dlx')),
            ['order_by' => 'tipo_info_rede_social, tipo_info_nome']
        );

        # Visão
        $this->visao->adicionarTemplate('comum/visoes/menu_opcoes');
        $this->visao->adicionarTemplate('comum/visoes/form_filtro');
        $this->visao->adicionarTemplate('comum/visoes/lista');

        # JS
        $this->visao->adicionarJS('web/js/jquery-mostrar-msg/jquery.mostrarmsg.plugin-min.js');

        # Parâmetros
        $this->visao->tituloPagina($this->visao->traduzir('Tipo de informações de contato', 'painel-dlx'));
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
        $this->gerarForm('tipo-info', 'website/tipos-de-informacoes/inserir', 'website/tipos-de-informacoes/salvar', $pk);

        # Visão
        $this->visao->adicionarTemplate('comum/visoes/menu_opcoes');
        $this->visao->adicionarTemplate('form_tipo_info');
        $this->visao->adicionarTemplate('comum/visoes/form_ajax');

        # JS
        $this->visao->adicionarJS('web/js/jquery-form-ajax/jquery.formajax.plugin-min.js');
        $this->visao->adicionarJS('web/js/jquery-mostrar-msg/jquery.mostrarmsg.plugin.js');

        $this->visao->mostrarConteudo();
    } // Fim do método mostrarForm


    /**
     * Identificar as configurações de um determinado tipo de informação.
     *
     * @param int $tipo ID do tipo de informação de contato a obter as suas configurações.
     * @return void Esse método não retorna nada, apenas escreve as configurações no formato JSON.
     * Retorna FALSE para o JSON quando o tipo de informação não foi localizado.
     */
    public function configuracoes($tipo) {
        $this->modelo->selecionarPK(filter_var($tipo, FILTER_VALIDATE_INT));
        echo !$this->modelo->reg_vazio
            ? json_encode([
                'prefixo' => $this->modelo->getPrefixo(),
                'validacao' => $this->modelo->getValidacao(),
                'mascara' => $this->modelo->getMask()
            ])
            : 'false';
    } // Fim do método configuracoes
}// Fim do controle TipoInfo
