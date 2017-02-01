<?php

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class AppKernel extends \Symfony\Component\HttpKernel\Kernel
{
    /**
     * Returns an array of bundles to register.
     *
     * @return \Symfony\Component\HttpKernel\Bundle\BundleInterface An array of bundle instances
     */
    public function registerBundles()
    {
        return [
            new \AppBundle\AppBundle()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function handle(\Symfony\Component\HttpFoundation\Request $request, $type = \Symfony\Component\HttpKernel\HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $request->attributes->add(['_controller' => \AppBundle\Controller\DefaultController::class . '::indexAction']);

        return parent::handle($request, $type, $catch);
    }


    /**
     * Loads the container configuration.
     *
     * @param \Symfony\Component\Config\Loader\LoaderInterface $loader A LoaderInterface instance
     */
    public function registerContainerConfiguration(\Symfony\Component\Config\Loader\LoaderInterface $loader)
    {
        $loader->load(function (\Symfony\Component\DependencyInjection\ContainerBuilder $c) use ($loader) {

            $c->setDefinition('app.logger.console_handler',
                new Definition(\Monolog\Handler\BrowserConsoleHandler::class));

            $loggerDefinition = new Definition(\Monolog\Logger::class, ['Lean Symfony']);
            $loggerDefinition->addMethodCall('pushHandler', [new Reference('app.logger.console_handler')]);
            $c->setDefinition('app.kernel.logger', $loggerDefinition);

            $c->setDefinition('app.event_dispatcher',
                new Definition(\LeanSymfony\Component\EventDispatcher\EventDispatcher::class, [
                    new Reference('app.kernel.logger')
                ])
            );

            $c->setDefinition('app.controller_resolver',
                new Definition(\Symfony\Component\HttpKernel\Controller\ControllerResolver::class, [
                    new Reference('app.kernel.logger')
                ])
            );

            $c->setDefinition('http_kernel',
                new Definition(\Symfony\Component\HttpKernel\HttpKernel::class, [
                    new Reference('app.event_dispatcher'),
                    new Reference('app.controller_resolver')
                ])
            );

            $c->addObjectResource($this);
        });
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function gestLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }
}