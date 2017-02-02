<?php

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class AppKernel extends \Symfony\Component\HttpKernel\Kernel
{
    /**
     * Returns an array of bundles to register.
     *
     * @return \Symfony\Component\HttpKernel\Bundle\BundleInterface[] An array of bundle instances
     */
    public function registerBundles()
    {
        $bundles = [
            new \LeanSymfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \AppBundle\AppBundle()
        ];

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(\Symfony\Component\HttpFoundation\Request $request, $type = \Symfony\Component\HttpKernel\HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $request->attributes->add(['_controller' => \AppBundle\Controller\DefaultController::class . ':indexAction']);

        return parent::handle($request, $type, $catch);
    }


    /**
     * Loads the container configuration.
     *
     * @param \Symfony\Component\Config\Loader\LoaderInterface $loader A LoaderInterface instance
     */
    public function registerContainerConfiguration(\Symfony\Component\Config\Loader\LoaderInterface $loader)
    {
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