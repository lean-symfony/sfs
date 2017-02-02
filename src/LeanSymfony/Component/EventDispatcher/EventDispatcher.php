<?php

namespace LeanSymfony\Component\EventDispatcher;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;

class EventDispatcher extends ContainerAwareEventDispatcher
{
    /**
     * @var LoggerInterface
     */
    private $log;

    /**
     * EventDispatcher constructor.
     * @param ContainerInterface $container
     * @param LoggerInterface $log
     */
    public function __construct(ContainerInterface $container, LoggerInterface $log)
    {
        parent::__construct($container);

        $this->log = $log;
    }

    /**
     * @param string $eventName
     * @param Event|null $event
     * @return Event
     */
    public function dispatch($eventName, Event $event = null)
    {
        $this->log->info($eventName);

        return parent::dispatch($eventName, $event);
    }


}