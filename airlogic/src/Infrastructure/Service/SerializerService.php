<?php

namespace App\Infrastructure\Service;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

/**
 *
 */
class SerializerService
{
    /**
     * @var SerializerBuilder
     */
    private SerializerBuilder $serializer;

    /**
     * @return Serializer
     */
    public function getSerializer(): Serializer
    {
        return $this->serializer::create()->build();
    }

    /**
     * @param SerializerBuilder $serializer
     */
    public function __construct(SerializerBuilder $serializer)
    {
        $this->serializer = $serializer;
    }
}