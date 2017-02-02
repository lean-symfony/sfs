<?php

namespace LeanSymfony\Bundle\FrameworkBundle\Templating;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\DelegatingEngine;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class TemplateEngine
 * @package LeanSymfony\Bundle\FrameworkBundle\Templating
 */
class TemplateEngine extends DelegatingEngine
{

    /**
     * TemplateEngine constructor.
     *
     * @param EngineInterface[] $engines
     */
    public function __construct(array $engines)
    {
        parent::__construct($engines);
    }

    /**
     * @param string $view
     * @param array $parameters
     * @param Response|null $response
     *
     * @return Response
     */
    public function response($view, array $parameters = [], Response $response = null)
    {
        $engine = $this->getEngine($view);

        if (null === $response) {
            $response = new Response();
        }

        $response->setContent($engine->render($view, $parameters));

        return $response;
    }
}