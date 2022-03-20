<?php

namespace App\Infrastructure\EventListener\Request;

use Symfony\Component\HttpKernel\Event\RequestEvent;

/**
 *
 */
class RequestListener
{
    /**
     * @param RequestEvent $event
     * @return void
     */
    public function  onKernelRequest(RequestEvent $event)
    {
        $_ENV['LOCALE'] = $event->getRequest()->getLocale();
    }
}