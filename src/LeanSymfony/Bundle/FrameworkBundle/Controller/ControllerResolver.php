<?php

namespace LeanSymfony\Bundle\FrameworkBundle\Controller;

use Symfony\Component\HttpKernel\Controller\ControllerResolver as BaseControllerResolver;

class ControllerResolver extends BaseControllerResolver
{
    protected function createController($controller)
    {
        if (false === strpos($controller, '::')) {
            $count = substr_count($controller, ':');
            if (1 == $count) {
                // controller in the service:method notation
                list($service, $method) = explode(':', $controller, 2);

                // TODO: container lookup
                // return array($this->container->get($service), $method);

                $ctrl = new $service();
                return array($ctrl, $method);
            } else {
                throw new \LogicException(sprintf('Unable to parse the controller name "%s".', $controller));
            }
        }

        return parent::createController($controller);
    }
}