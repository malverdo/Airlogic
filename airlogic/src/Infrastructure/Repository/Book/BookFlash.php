<?php

namespace App\Infrastructure\Repository\Book;

use App\Infrastructure\Repository\BaseRepository\Contracts\FlashInterface;

class BookFlash implements FlashInterface
{
    public  function getMiss(): string
    {
        return  'Книги не существует';
    }

    public static function getBookNotFound(): array
    {
        return  ['message' => 'Книга не найдена'];
    }

    public static function getBookCreate(): string
    {
        return  'Книга успешно создана';
    }
}