<?php

namespace LeanSymfony\Bundle\FrameworkBundle\Container;

use Acclimate\Container\CompositeContainer;
use Acclimate\Container\ContainerAcclimator;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DIContainerFactory
{
    /**
     * @return \DI\Container
     */
    public static function createDIContainer(ContainerInterface $symfonyContainer)
    {
        $acclimator = new ContainerAcclimator();
        $symfonyContainer = $acclimator->acclimate($symfonyContainer);


        $compositeContainer = new CompositeContainer();

        // add symfony container
        $compositeContainer->addContainer($symfonyContainer);

        $builder = new \DI\ContainerBuilder();
        $builder->useAnnotations(true);
        $builder->wrapContainer($compositeContainer);

        $compositeContainer->addContainer($builder->build());

        return $compositeContainer;
    }
}