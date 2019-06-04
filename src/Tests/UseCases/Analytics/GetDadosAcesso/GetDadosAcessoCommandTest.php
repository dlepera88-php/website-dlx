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

namespace Website\Tests\UseCases\Analytics\GetDadosAcesso;


use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Website\UseCases\Analytics\GetDadosAcesso\GetDadosAcessoCommand;

/**
 * Class GetDadosAcessoCommandTest
 * @package Website\Tests\UseCases\Analytics\GetDadosAcesso
 * @coversDefaultClass \Website\UseCases\Analytics\GetDadosAcesso\GetDadosAcessoCommand
 */
class GetDadosAcessoCommandTest extends TestCase
{
    /**
     * @return GetDadosAcessoCommand
     * @throws Exception
     */
    public function test__construct(): GetDadosAcessoCommand
    {
        $command = new GetDadosAcessoCommand(
            '123456789',
            new DateTime(),
            new DateTime(),
            ['sessions']
        );

        $this->assertInstanceOf(GetDadosAcessoCommand::class, $command);

        return $command;
    }

    /**
     * @param GetDadosAcessoCommand $command
     * @covers ::getId
     * @depends test__construct
     */
    public function test_GetId(GetDadosAcessoCommand $command)
    {
        $this->assertIsString($command->getId());
    }

    /**
     * @param GetDadosAcessoCommand $command
     * @covers ::getDataInicial
     * @depends test__construct
     */
    public function test_GetDataInicial(GetDadosAcessoCommand $command)
    {
        $this->assertInstanceOf(DateTime::class, $command->getDataInicial());
    }

    /**
     * @param GetDadosAcessoCommand $command
     * @covers ::getDataFinal
     * @depends test__construct
     */
    public function test_GetDataFinal(GetDadosAcessoCommand $command)
    {
        $this->assertInstanceOf(DateTime::class, $command->getDataFinal());
    }

    /**
     * @param GetDadosAcessoCommand $command
     * @covers ::getMetricas
     * @depends test__construct
     */
    public function test_GetMetricas(GetDadosAcessoCommand $command)
    {
        $this->assertIsArray($command->getMetricas());
    }
}
