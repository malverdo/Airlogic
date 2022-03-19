<?php

namespace App\Infrastructure\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Infrastructure\Exception\InvalidRequestException;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::EXCEPTION => [
                ['InvalidArgumentException', 10]
            ],
        ];
    }

    public function InvalidArgumentException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        if (is_a($exception,'App\Infrastructure\Exception\InvalidRequestException') ) {
            $array = ['Error' =>  $exception->getMessage()];
            $response = new JsonResponse();
            $response->setContent(json_encode($array, JSON_UNESCAPED_UNICODE));
            if ($exception instanceof HttpExceptionInterface) {
                $response->setStatusCode($exception->getStatusCode());
                $response->headers->replace($exception->getHeaders());
            } else {
                $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $event->setResponse($response);
        }
    }


}