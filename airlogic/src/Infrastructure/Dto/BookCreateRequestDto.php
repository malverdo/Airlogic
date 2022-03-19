<?php

namespace App\Infrastructure\Dto;

use App\Infrastructure\Repository\BaseRepository\Contracts\DtoInterface;

class BookCreateRequestDto implements DtoInterface
{
    public string $name;

    public string $authorId;
}