<?php

namespace App\Infrastructure\Repository\Author;

use App\Infrastructure\Repository\BaseRepository\Contracts\FlashInterface;

class AuthorFlash implements FlashInterface
{
    public function getMiss(): string
    {
        return  'Автора не существует';
    }

    public static function getAuthorNotFound(): array
    {
        return  ['message' => 'Автор не найден'];
    }

    public static function getAuthorCreate(): string
    {
        return   'Автор успешно создан';
    }
}