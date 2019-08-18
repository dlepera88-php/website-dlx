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

namespace Website\Tests\Domain\Contato\Entities;

use PHPUnit\Framework\TestCase;
use Website\Domain\Contato\Entities\InformacaoContatoTipo;

/**
 * Class InformacaoContatoTipoTest
 * @package Website\Tests\Domain\Contato\Entities
 * @coversDefaultClass \Website\Domain\Contato\Entities\InformacaoContatoTipo
 */
class InformacaoContatoTipoTest extends TestCase
{
    /**
     * @return InformacaoContatoTipo
     */
    public function test__construct(): InformacaoContatoTipo
    {
        $descricao = 'Tipo de Informação';
        $rede_social = (bool)mt_rand(0,1);
        $tipo = new InformacaoContatoTipo($descricao, $rede_social);

        $this->assertEquals($descricao, $tipo->getNome());
        $this->assertEquals($descricao, (string)$tipo);
        $this->assertEquals($rede_social, $tipo->isRedeSocial());

        return $tipo;
    }
}
