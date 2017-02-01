<?php

namespace LeanSymfony\Component\EventDispatcher;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher as BaseEventDispatcher;

class EventDispatcher extends BaseEventDispatcher
{
    /**
     * @var LoggerInterface
     */
    private $log;

    /**
     * EventDispatcher constructor.
     * @param LoggerInterface $log
     */
    public function __construct(LoggerInterface $log)
    {
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