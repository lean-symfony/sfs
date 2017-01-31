<?php

// Composer autoloader
require '../vendor/autoload.php';

// Request and Response abstraction

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$error = '';
$posted = false;

if ($request->getMethod() === 'POST') {

    $name = $request->get('name','');

    if (strlen($name) > 0) {
        $posted = true;
    } else {
        $error = 'Ohne deinen Namen geht es hier nicht weiter ...';
    }
}

$template = file_get_contents('../app/Resources/views/index.html.php');
$content = eval("?>$template");

$response = new Response($content);
echo $response;
