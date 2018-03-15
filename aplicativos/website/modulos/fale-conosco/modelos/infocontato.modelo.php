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

namespace Website\FaleConosco\Modelos;

use Comum\DTO\InfoContato as InfoContatoDTO;
use Geral\Modelos\BaseModeloRegistro;
use Geral\Modelos\RegistroConsulta;

class InfoContato extends BaseModeloRegistro {
    use RegistroConsulta, InfoContatoDTO;

    public function __construct($pk = null) {
        parent::__construct('dlx_websitedlx_infos_contato', 'info_contato_');
        $this->bd_lista->join('dlx_websitedlx_tipos_infos', 'T', "(T.tipo_info_id = {$this->getBdPrefixo()}tipo)", 'INNER');
        $this->selecionarPK($pk);
    } // Fim do método __construct

    /**
     * Listar apenas as redes sociais
     *
     * @return array Retorna um array com as informações das redes sociais, ou um array vazio, caso nenhuma
     * rede social tenha sido encontrada.
     */
    public function listarRedesSociais() {
        return $this->listar((object)[
            'where' => ["{$this->getBdPrefixo()}publicar = 1", "{$this->getBdPrefixo()}rede_social = 1"]
        ]);
    } // Fim do método listarRedesSociais

    public function listarInfosContato() {
        return $this->listar((object)[
            'where' => ["{$this->getBdPrefixo()}publicar = 1", "{$this->getBdPrefixo()}rede_social = 0"]
        ]);
    } // Fim do método listarInfosContato
} // Fim do modelo InfoContato
