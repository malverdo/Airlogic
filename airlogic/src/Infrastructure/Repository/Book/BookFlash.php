<?php

namespace App\Infrastructure\Repository\Book;

use App\Infrastructure\Repository\BaseRepository\Contracts\FlashInterface;

/**
 *
 */
class BookFlash implements FlashInterface
{
    /**
     * @return string
     */
    public  function getMiss(): string
    {
        return  'Книги не существует';
    }

    /**
     * @return string[]
     */
    public static function getBookNotFound(): array
    {
        return  ['message' => 'Книга не найдена'];
    }

    /**
     * @return string
     */
    public static function getBookCreate(): string
    {
        return  'Книга успешно создана';
    }
}