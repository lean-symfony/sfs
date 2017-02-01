<?php

// Composer autoloader
require '../vendor/autoload.php';

$request =  \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$ctrl = new \AppBundle\Controller\DefaultController();
$response = $ctrl->indexAction($request);

$response->send();
