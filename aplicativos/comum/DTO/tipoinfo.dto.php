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

trait TipoInfo {
    /**
     * @var string $nome
     * Nome desse tipo de informação de contato.
     */
    protected $nome;

    /**
     * Prefixo da informação de contato.
     * Ex: https://facebook.com.br/[link-facebook]
     *
     * @var string|null
     */
    protected $prefixo;

    /**
     * @var bool $rede_social
     * Define se esse tipo de informação é uma rede social ou não.
     */
    protected $rede_social;

    /**
     * @var string $validacao [opcional]
     * Expressão regular para validação dessa informação.
     */
    protected $validacao;

    /**
     * @var string $mask [opcional]
     * Máscara a ser aplicada na informação.
     */
    protected $mask;

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = filter_var($nome);
    }

    public function getPrefixo() {
        return $this->prefixo;
    }

    public function setPrefixo($fixo) {
        $this->prefixo = filter_var($fixo);
    }
    
    public function isRedeSocial() {
        return (bool)$this->rede_social;
    }

    public function setRedeSocial($rede_social) {
        $this->rede_social = filter_var($rede_social, FILTER_VALIDATE_BOOLEAN);
    }

    public function getValidacao() {
        return $this->validacao;
    }

    public function setValidacao($validacao) {
        $this->validacao = filter_var($validacao, FILTER_SANITIZE_STRING);
    }

    public function getMask() {
        return $this->mask;
    }

    public function setMask($mask) {
        $this->mask = filter_var($mask);
    }
}
