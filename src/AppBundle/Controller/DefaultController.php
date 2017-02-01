<?php

namespace AppBundle\Controller;

// Request and Response abstraction
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
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

        ob_start();
        require '../app/Resources/views/index.html.php';
        $content = ob_get_clean();

        return new Response($content);
    }
}