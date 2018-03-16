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

namespace Comum\DTO;

trait InfoContato {
    /**
     * @var int $tipo
     * ID que indica qual o tipo dessa informação de contato.
     */
    protected $tipo;

    /**
     * @var string $valor
     * Valor da informação de contato. Pode ser um número de telefone, um email,
     * um endereço, etc.
     */
    protected $valor;

    /**
     * Forma de exibir o valor dessa informação de contato para melhor entendimento humano.
     * @var string
     */
    protected $exibicao;

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = filter_var($tipo, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1],
            'flags' => FILTER_NULL_ON_FAILURE
        ]);
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = filter_var($valor, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
    }

    public function getExibicao() {
        return $this->exibicao;
    }

    public function setExibicao($exibicao) {
        $this->exibicao = filter_var($exibicao, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
    }
}
