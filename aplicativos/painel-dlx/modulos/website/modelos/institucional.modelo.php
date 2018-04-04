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

use Comum\DTO\Institucional as InstitucionalDTO;
use DLX\Ajudantes\Visao as AjdVisao;
use DLX\Excecao\DLX as ExDLX;
use Geral\Modelos\BaseModeloRegistro;
use Geral\Modelos\RegistroConsulta;
use Geral\Modelos\RegistroEdicao;

class Institucional extends BaseModeloRegistro {
    use RegistroConsulta, RegistroEdicao, InstitucionalDTO;

    public function __construct($idioma = null) {
        parent::__construct('dlx_websitedlx_institucional', 'instit_');
        $this->set__NomeModelo(AjdVisao::traduzirTexto('institucional', 'website-dlx'));
        // Permitir a inclusão de valores no campo definido como PK
        $this->insert_pk = true;

        $this->adicionarEvento('antes', 'salvar', function () {
            // Ao incluir um novo registros, é necessário verificar se a sigla já está sendo usada.
            if($this->reg_vazio) {
                if ($this->qtdeRegistros((object)['where' => "{$this->getBdTabela()}idioma = '{$this->getIdioma()}'"]) > 0) {
                    throw new ExDLX(
                        sprintf(AjdVisao::traduzirTexto('Essa tag de idioma já está sendo utilizada. Se você deseja atualizar as informações institucionais para esse idioma <a href="website/institucional/editar/%s">clique aqui</a>. Caso contrário, informe um idioma diferente e tente novamente.', 'website-dlx'), $this->getIdioma()),
                        1403, '-info'
                    );
                } // Fim if
            } // Fim if
        });

        $this->selecionarPK($idioma);
    } // Fim do método __construct
} // Fim do modelo Institucional
