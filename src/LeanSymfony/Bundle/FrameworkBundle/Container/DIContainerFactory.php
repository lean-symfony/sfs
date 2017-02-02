<?php

namespace LeanSymfony\Bundle\FrameworkBundle\Container;

class DIContainerFactory
{
    /**
     * @return \DI\Container
     */
    public static function createDIContainer()
    {
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();

        return $container;
    }
}