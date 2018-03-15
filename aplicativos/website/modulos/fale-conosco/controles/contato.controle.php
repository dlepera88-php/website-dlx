<?php
/**
 * painel-dlx
 * @version: v1.17.08
 * @author: Diego Lepera
 *
 * Created by Diego Lepera on 2017-07-28. Please report any bug at
 * https://github.com/dlepera88-php/framework-dlx/issues
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

namespace Website\FaleConosco\Controles;

use DLX\Ajudantes\ConstrutorSQL as AjdConstrutorSQL;
use Geral\Controles\WebsiteDLX;
use Geral\Controles\RegistroConsulta;
use Geral\Controles\RegistroEdicao;
use Website\FaleConosco\Modelos\AssuntoContato;

class Contato extends WebsiteDLX {
    use RegistroConsulta, RegistroEdicao;

    public function __construct() {
        parent::__construct(dirname(__DIR__));
        $this->setModelo(new \Website\FaleConosco\Modelos\Contato());
    } // Fim do método __construct


    /**
     * Mostrar formulário de inclusão / edição do registro
     * @param  int $pk PK identificadora do registro. Quando não informada, o
     * formulário considerará que um novo registro será incluído.
     * @return void
     */
    protected function mostrarForm() {
        $this->gerarForm('contato', 'fale-conosco/enviar-contato', null, 'fale-conosco');

        $assunto = new AssuntoContato();

        # Visão
        $this->visao->adicionarTemplate('form_contato');
        $this->visao->adicionarTemplate('comum/visoes/form_ajax');

        # JS
        $this->visao->adicionarJS('web/js/jquery-form-ajax/jquery.formajax.plugin-min.js');
        $this->visao->adicionarJS('web/js/jquery-mostrar-msg/jquery.mostrarmsg.plugin.js');
        $this->visao->adicionarJS('web/js/jquery-mascara/jquery.mascara.plugin.js');

        # Parâmetros
        $this->visao->tituloPagina($this->visao->traduzir('Fale conosco', 'website-dlx'));
        $this->visao->adicionarParam('lista:assuntos', $assunto->carregarSelect((object)['where' => 'assunto_contato_publicar = 1'], false, 'id', 'texto'));

        $this->visao->mostrarConteudo();
    } // Fim do método mostrarForm


    /**
     * Salvar o contato e enviar por email
     * @return void
     */
    protected function enviarContato() {
        $this->salvar();
        /* TODO: Enviar email */
    } // Fim do método enviarContato
}// Fim do controle FaleConosco
