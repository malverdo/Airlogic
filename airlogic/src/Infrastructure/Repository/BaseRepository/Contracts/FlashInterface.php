<?php

namespace App\Infrastructure\Repository\BaseRepository\Contracts;

interface FlashInterface
{
    public function getMiss(): string;
}