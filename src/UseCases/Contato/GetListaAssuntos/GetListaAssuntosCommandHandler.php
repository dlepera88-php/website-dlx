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

namespace Website\UseCases\Contato\GetListaAssuntos;


use Website\Domain\Contato\Entities\AssuntoContato;
use Website\Domain\Contato\Repositories\AssuntoContatoRepositoryInterface;

/**
 * Class GetListaAssuntosCommandHandler
 * @package Website\UseCases\Contato\GetListaAssuntos
 * @covers GetListaAssuntosCommandHandlerTest
 */
class GetListaAssuntosCommandHandler
{
    /**
     * @var AssuntoContatoRepositoryInterface
     */
    private $assunto_contato_repository;

    /**
     * GetListaAssuntosCommandHandler constructor.
     * @param AssuntoContatoRepositoryInterface $assunto_contato_repository
     */
    public function __construct(AssuntoContatoRepositoryInterface $assunto_contato_repository)
    {
        $this->assunto_contato_repository = $assunto_contato_repository;
    }

    /**
     * @param GetListaAssuntosCommand $command
     * @return array
     */
    public function handle(GetListaAssuntosCommand $command): array
    {
        $criteria = $command->getCriteria();
        $criteria['and'] = ['deletado' => false];

        return $this->assunto_contato_repository->findByLike(
            $command->getCriteria(),
            $command->getOrderBy(),
            $command->getLimit(),
            $command->getOffset()
        );
    }
}