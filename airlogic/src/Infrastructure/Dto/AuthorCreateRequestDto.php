<?php

namespace App\Infrastructure\Dto;

use App\Infrastructure\Repository\BaseRepository\Contracts\DtoInterface;

class AuthorCreateRequestDto  implements DtoInterface
{
    public string $name;
}