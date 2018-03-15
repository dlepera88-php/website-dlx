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
use PainelDLX\Desenvolvedor\Modelos\Tema;

class Configuracoes extends PainelDLX {
    use RegistroConsulta, RegistroEdicao;

    public function __construct() {
        parent::__construct(dirname(__DIR__), new \PainelDLX\Website\Modelos\Configuracoes(), 'website/configuracoes');

        $this->adicionarEvento('depois', 'mostrarDetalhes', function () {
            $tema = new Tema($this->modelo->getTema());

            # Visão
            $this->visao->adicionarTemplate('det_config');

            # Parâmetros
            $this->visao->tituloPagina($this->visao->traduzir('Configurações do website', 'website-dlx'));
            $this->visao->adicionarParam('info:nome-tema', $tema->getNome());

            $this->visao->mostrarConteudo();
        });
    } // Fim do método __construct


    /**
     * Mostrar formulário de inclusão / edição do registro
     * @param  int $pk PK identificadora do registro. Quando não informada, o
     * formulário considerará que um novo registro será incluído.
     * @return void
     */
    protected function mostrarForm($pk = null) {
        $this->gerarForm('config', null, 'website/configuracoes/salvar', $pk);

        $tema = new Tema();

        # Visão
        $this->visao->adicionarTemplate('comum/visoes/menu_opcoes');
        $this->visao->adicionarTemplate('form_config');
        $this->visao->adicionarTemplate('comum/visoes/form_ajax');

        # JS
        $this->visao->adicionarJS('web/js/jquery-form-ajax/jquery.formajax.plugin-min.js');
        $this->visao->adicionarJS('web/js/jquery-mostrar-msg/jquery.mostrarmsg.plugin.js');

        # Parâmetros
        $this->visao->adicionarParam('lista:temas', $tema->carregarSelect(false));

        $this->visao->mostrarConteudo();
    } // Fim do método mostrarForm
}// Fim do controle Controle
