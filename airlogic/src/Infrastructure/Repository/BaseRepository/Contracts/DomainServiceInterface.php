<?php

namespace App\Infrastructure\Repository\BaseRepository\Contracts;



interface DomainServiceInterface
{
    /**
     * @return string
     */
    public function getNameEntity(): string;
}