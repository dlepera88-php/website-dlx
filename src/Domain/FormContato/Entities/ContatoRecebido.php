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

namespace Website\Domain\FormContato\Entities;


use DLX\Domain\Entities\Entity;
use PainelDLX\Domain\Common\Entities\LogRegistroTrait;

class ContatoRecebido extends Entity
{
    const TABELA_BD = 'dlx_contatos_recebidos';
    use LogRegistroTrait;

    /** @var int|null */
    private $id;
    /** @var AssuntoContato|null */
    private $assunto;
    /** @var string */
    private $nome;
    /** @var string */
    private $email;
    /** @var string */
    private $telefone;
    /** @var string */
    private $mensagem;
    /** @var bool */
    private $deletado = false;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return ContatoRecebido
     */
    public function setId(?int $id): ContatoRecebido
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return AssuntoContato|null
     */
    public function getAssunto(): ?AssuntoContato
    {
        return $this->assunto;
    }

    /**
     * @param AssuntoContato|null $assunto
     * @return ContatoRecebido
     */
    public function setAssunto(?AssuntoContato $assunto): ContatoRecebido
    {
        $this->assunto = $assunto;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return ContatoRecebido
     */
    public function setNome(string $nome): ContatoRecebido
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return ContatoRecebido
     */
    public function setEmail(string $email): ContatoRecebido
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefone(): string
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     * @return ContatoRecebido
     */
    public function setTelefone(string $telefone): ContatoRecebido
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return string
     */
    public function getMensagem(): string
    {
        return $this->mensagem;
    }

    /**
     * @param string $mensagem
     * @return ContatoRecebido
     */
    public function setMensagem(string $mensagem): ContatoRecebido
    {
        $this->mensagem = $mensagem;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDeletado(): bool
    {
        return $this->deletado;
    }
}