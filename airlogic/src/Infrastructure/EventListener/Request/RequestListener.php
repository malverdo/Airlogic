<?php

namespace App\Infrastructure\EventListener\Request;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    public function  onKernelRequest(RequestEvent $event)
    {
        $_ENV['LOCALE'] = $event->getRequest()->getLocale();
    }
}