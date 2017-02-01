<?php

// Composer autoloader
require '../vendor/autoload.php';

// Enable debugging infos
\Symfony\Component\Debug\Debug::enable();

// Create a plain HttpKernel
$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
$resolver = new \Symfony\Component\HttpKernel\Controller\ControllerResolver();
$kernel = new \Symfony\Component\HttpKernel\HttpKernel($dispatcher,$resolver);

$request =  \Symfony\Component\HttpFoundation\Request::createFromGlobals();

// as of no router present, i'm setting the controller manually
$ctrl = new \AppBundle\Controller\DefaultController();
$request->attributes->add(['_controller' => [$ctrl,'indexAction']]);

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request,$response);
