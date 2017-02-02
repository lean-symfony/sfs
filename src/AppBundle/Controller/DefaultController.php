<?php

namespace AppBundle\Controller;

// Request and Response abstraction
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Psr\Log\LoggerInterface;
use LeanSymfony\Bundle\FrameworkBundle\Templating\TemplateEngine;

class DefaultController
{
    /**
     * @var LoggerInterface
     * @Inject("lean.logger")
     */
    private $log;

    /**
     * @var TemplateEngine
     * @Inject("templating")
     */
    private $view;

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $this->log->notice('Default:index action');

        $error = '';
        $posted = false;
        $name = '';

        if ($request->getMethod() === 'POST') {

            $name = $request->get('name','');

            if (strlen($name) > 0) {
                $posted = true;
            } else {
                $error = 'Ohne deinen Namen geht es hier nicht weiter ...';
            }
        }

        return $this->view->response('index.html.php', [
            'posted' => $posted,
            'error' => $error,
            'name' => $name
        ]);
    }
}