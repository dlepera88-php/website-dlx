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

namespace Geral\Controles;

use Comum\Modelos\Configuracoes;
use PainelDLX\Desenvolvedor\Modelos\Modulo;
use PainelDLX\Desenvolvedor\Modelos\Tema;
use Website\FaleConosco\Modelos\InfoContato;

abstract class WebsiteDLX extends BaseControleRegistro {
    /**
     * PainelDLX constructor.
     * @param string   $diretorio_visao Diretório de fontes para a visão
     */
    public function __construct($diretorio_visao = '.', $modelo = null) {
        parent::__construct($diretorio_visao, $modelo);
        
        $modulo = new Modulo();
        $config = new Configuracoes();
        $tema = new Tema($config->getTema());
        $info_contato = new InfoContato();
        
        # Adicionar templates fixos
        $this->visao->adicionarTemplate('comum/visoes/topo', -1, true, true);
        $this->visao->adicionarTemplate('comum/visoes/menu');
        $this->visao->adicionarTemplate('comum/visoes/mensagens_usuario');
        $this->visao->adicionarTemplate('comum/visoes/rodape', -1, true, true);
        $this->visao->adicionarTemplate('comum/visoes/google_analytics', -1, true, true);

        # Adicionar o suporte ao jQuery a esse aplicativo
        $this->visao->adicionarJS('web/js/jquery-3.2.1.min.js', -1);
        $this->visao->adicionarJS('web/js/framework-dlx-min.js', 0);

        # Parâmetros comuns para todas as visões
        $this->visao->adicionarParam('html:itens-menu', $modulo->itensMenu());
        $this->visao->adicionarParam('lista:infos-contato', $info_contato->listarInfosContato());
        $this->visao->adicionarParam('lista:redes-sociais', $info_contato->listarRedesSociais());
        $this->visao->adicionarParam('conf:ga-ua', $config->getGaUa());

        # Modificar a página mestra de acordo com a preferência do usuário
        $this->visao->setTema($tema->getID());
        $this->visao->setPaginaMestra($tema->getPaginaMestra());
    } // Fim do método __construct
} // Fim do controle WebsiteDLX
