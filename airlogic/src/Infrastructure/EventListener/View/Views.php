<?php

namespace App\Infrastructure\EventListener\Views;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;

/**
 *
 */
class Views
{
    /**
     * @param ViewEvent $event
     * @return void
     */
    public function onKernelView(ViewEvent $event)
    {
        $value = $event->getControllerResult();
        $response = new JsonResponse($value);
        $event->setResponse($response);
    }
}