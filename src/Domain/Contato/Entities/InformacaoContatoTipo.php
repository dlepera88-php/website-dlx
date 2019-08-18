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

namespace Website\Domain\Contato\Entities;


use DLX\Domain\Entities\Entity;

/**
 * Class InformacaoContatoTipo
 * @package Website\Domain\Contato\Entities
 * @covers InformacaoContatoTipoTest
 */
class InformacaoContatoTipo extends Entity
{
    /** @var int|null */
    private $id;
    /** @var string */
    private $nome;
    /** @var bool */
    private $rede_social = false;
    /** @var string|null */
    private $prefixo;
    /** @var bool */
    private $deletado = false;

    /**
     * InformacaoContatoTipo constructor.
     * @param string $nome
     * @param bool $rede_social
     * @param string|null $prefixo
     */
    public function __construct(string $nome, bool $rede_social, ?string $prefixo = null)
    {
        $this->nome = $nome;
        $this->rede_social = $rede_social;
        $this->prefixo = $prefixo;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @return bool
     */
    public function isRedeSocial(): bool
    {
        return $this->rede_social;
    }

    /**
     * @return string|null
     */
    public function getPrefixo(): ?string
    {
        return $this->prefixo;
    }

    /**
     * @return bool
     */
    public function isDeletado(): bool
    {
        return $this->deletado;
    }

    public function __toString()
    {
        return $this->getNome();
    }
}