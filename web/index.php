<?php

// Composer autoloader
require '../vendor/autoload.php';

// Enable debugging infos
\Symfony\Component\Debug\Debug::enable();

// And the Application Kernel
$kernel = new AppKernel('dev', true);

$request =  \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request,$response);
