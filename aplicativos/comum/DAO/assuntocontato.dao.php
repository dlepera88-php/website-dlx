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

namespace Comum\DAO;

trait AssuntoContato {
    /**
     * Texto do assunto
     * @var string
     */
    protected $texto;

    /**
     * Cor de exibição desse assunto
     * @var string
     */
    protected $cor = '#000000';

    /**
     * Email que deverá receber os contatos referentes a esse assunto
     * @var string
     */
    protected $email;

	public function getTexto() {
		return $this->texto;
	}

	public function setTexto($texto) {
		$this->texto = filter_var($texto, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
	}

	public function getCor() {
		return $this->cor;
	}

	public function setCor($cor) {
		$this->cor = filter_var($cor, FILTER_VALIDATE_REGEXP, [
            'options' => ['regexp' => '~^#[0-9a-fA-F]{3,6}$~', 'default' => '#000']
        ]);
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE);
	}
}
