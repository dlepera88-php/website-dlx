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

namespace Website\Application\ServiceProviders;


use DLX\Core\Configure;
use League\Container\Container;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Tactician\CommandBus;
use PainelDLX\Application\Factories\CommandBusFactory;
use PainelDLX\Infrastructure\ORM\Doctrine\Services\RepositoryFactory;
use SechianeX\Contracts\SessionInterface;
use SechianeX\Exceptions\SessionAdapterInterfaceInvalidaException;
use SechianeX\Exceptions\SessionAdapterNaoEncontradoException;
use SechianeX\Factories\SessionFactory;
use Vilex\VileX;
use Website\Application\Services\Adapters\Analytics\GoogleAnalyticsAdapter;
use Website\Domain\Common\Adapters\AnalyticsAdapterInterface;
use Website\Domain\Contato\Entities\AssuntoContato;
use Website\Domain\Contato\Entities\ContatoRecebido;
use Website\Domain\Contato\Repositories\AssuntoContatoRepositoryInterface;
use Website\Domain\Contato\Repositories\ContatoRecebidoRepositoryInterface;

class WebsiteServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        AnalyticsAdapterInterface::class,
        CommandBus::class,
        VileX::class,
        AssuntoContatoRepositoryInterface::class,
        ContatoRecebidoRepositoryInterface::class,
        SessionInterface::class,
    ];

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     * @throws SessionAdapterInterfaceInvalidaException
     * @throws SessionAdapterNaoEncontradoException
     */
    public function register()
    {
        /** @var Container $container */
        $container = $this->getContainer();

        $container->add(
            CommandBus::class,
            CommandBusFactory::create($container, Configure::get('app', 'mapping'))
        );

        $container->add(
            VileX::class,
            new VileX
        );

        $container->add(
            AnalyticsAdapterInterface::class,
            function () {
                return new GoogleAnalyticsAdapter('config/website/brasilia-apart-hoteis.json', 'Brasília Apart Hotéis');
            }
        );

        $container->add(
            AssuntoContatoRepositoryInterface::class,
            RepositoryFactory::create(AssuntoContato::class)
        );

        $container->add(
            ContatoRecebidoRepositoryInterface::class,
            RepositoryFactory::create(ContatoRecebido::class)
        );

        $container->add(
            SessionInterface::class,
            SessionFactory::createPHPSession()
        );
    }
}