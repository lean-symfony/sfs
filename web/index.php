<?php

// Composer autoloader
require '../vendor/autoload.php';

// Enable debugging infos
\Symfony\Component\Debug\Debug::enable();

// And the Application Kernel with a registered http_kernel service
$kernel = new AppKernel('dev', true);

$request =  \Symfony\Component\HttpFoundation\Request::createFromGlobals();

// as of no router present, i'm setting the controller manually
$ctrl = new \AppBundle\Controller\DefaultController();
$request->attributes->add(['_controller' => [$ctrl,'indexAction']]);

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request,$response);
