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

trait Contato {
    /**
     * ID do assunto referente a essa
     * @var int
     */
    protected $assunto;

    /**
     * Nome do contato
     * @var string
     */
    protected $nome;

    /**
     * Email de contato para retorno
     * @var string
     */
    protected $email;

    /**
     * Telefone de contato para retorno
     * @var string
     */
    protected $telefone;

    /**
     * Mensagem
     * @var string
     */
    protected $mensagem;


	public function getAssunto() {
		return $this->assunto;
	}

	public function setAssunto($assunto) {
		$this->assunto = filter_var($assunto, FILTER_VALIDATE_INT, [
            'options'   => ['min_range' => 1],
            'flags'     => FILTER_NULL_ON_FAILURE
        ]);
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($nome) {
		$this->nome = filter_var($nome, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE);
	}

	public function getTelefone() {
		return $this->telefone;
	}

	public function setTelefone($telefone) {
		$this->telefone = filter_var($telefone, FILTER_VALIDATE_REGEXP, [
            'options'   => ['regexp' => '~^\(\d{2}\)\s([6-9]\s)?\d{4}-\d{4}$~'],
            'flags'     => FILTER_NULL_ON_FAILURE
        ]);
	}

	public function getMensagem() {
		return $this->mensagem;
	}

	public function setMensagem($mensagem) {
		$this->mensagem = filter_var($mensagem);
	}
}
