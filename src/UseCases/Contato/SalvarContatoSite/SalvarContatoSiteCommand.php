<?php
/**
 * MIT License
 *
 * Copyright (c) 2018 PHP DLX
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Website\UseCases\Contato\SalvarContatoSite;


use Website\Domain\Contato\Entities\AssuntoContato;

class SalvarContatoSiteCommand
{
    /**
     * @var AssuntoContato|null
     */
    private $assunto_contato;
    /**
     * @var string
     */
    private $nome;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string|null
     */
    private $telefone;
    /**
     * @var string
     */
    private $mensagem;

    /**
     * SalvarContatoSiteCommand constructor.
     * @param AssuntoContato|null $assunto_contato
     * @param string $nome
     * @param string $email
     * @param string|null $telefone
     * @param string $mensagem
     */
    public function __construct(
        ?AssuntoContato $assunto_contato,
        string $nome,
        string $email,
        ?string $telefone,
        string $mensagem
    ) {
        $this->assunto_contato = $assunto_contato;
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->mensagem = $mensagem;
    }

    /**
     * @return AssuntoContato|null
     */
    public function getAssuntoContato(): ?AssuntoContato
    {
        return $this->assunto_contato;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    /**
     * @return string
     */
    public function getMensagem(): string
    {
        return $this->mensagem;
    }
}