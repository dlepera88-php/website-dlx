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

namespace PainelDLX\Website\Modelos;

use Comum\DTO\TipoInfo as TipoInfoDTO;
use DLX\Ajudantes\Visao as AjdVisao;
use Geral\Modelos\BaseModeloRegistro;
use Geral\Modelos\RegistroConsulta;
use Geral\Modelos\RegistroEdicao;

class TipoInfo extends BaseModeloRegistro {
    use RegistroConsulta, RegistroEdicao, TipoInfoDTO;

    public function __construct($pk = null) {
        parent::__construct('dlx_websitedlx_tipos_infos', 'tipo_info_');
        $this->set__NomeModelo(AjdVisao::traduzirTexto('tipo de informação de contato', 'website-dlx'));
        $this->selecionarPK($pk);
    } // Fim do método __construct
} // Fim do modelo TipoInfo
