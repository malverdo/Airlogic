<?php

namespace App\Infrastructure\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 *
 */
class ExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @return \array[][]
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => [
                ['InvalidException', 10]
            ],
        ];
    }

    /**
     * @param ExceptionEvent $event
     * @return void
     */
    public function InvalidException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        if (
            is_a($exception,'App\Infrastructure\Exception\InvalidRequestException') ||
            is_a($exception,'App\Infrastructure\Repository\BaseRepository\Exception\NotFoundException')
        ) {
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