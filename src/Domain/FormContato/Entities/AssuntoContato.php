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

/**
 * Class AssuntoContato
 * @package Website\Domain\FormContato\Entities
 * @covers AssuntoContatoTest
 */
class AssuntoContato extends Entity
{
    const TABELA_BD = 'dlx_assuntos_contato';
    use LogRegistroTrait;

    /** @var int|null */
    private $id;
    /** @var string */
    private $descricao;
    /** @var string|null */
    private $email;
    /** @var bool */
    private $publicado = true;
    /** @var bool */
    private $deletado = false;

    /**
     * AssuntoContato constructor.
     * @param string $descricao
     * @param string|null $email
     */
    public function __construct(string $descricao, ?string $email = null)
    {
        $this->descricao = $descricao;
        $this->email = $email;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return AssuntoContato
     */
    public function setId(?int $id): AssuntoContato
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     * @return AssuntoContato
     */
    public function setDescricao(string $descricao): AssuntoContato
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return AssuntoContato
     */
    public function setEmail(?string $email): AssuntoContato
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPublicado(): bool
    {
        return $this->publicado;
    }

    /**
     * @param bool $publicado
     * @return AssuntoContato
     */
    public function setPublicado(bool $publicado): AssuntoContato
    {
        $this->publicado = $publicado;
        return $this;
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
        return $this->getDescricao();
    }
}