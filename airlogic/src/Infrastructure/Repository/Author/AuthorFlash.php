<?php

namespace App\Infrastructure\Repository\Author;

use App\Infrastructure\Repository\BaseRepository\Contracts\FlashInterface;

/**
 *
 */
class AuthorFlash implements FlashInterface
{
    /**
     * @return string
     */
    public function getMiss(): string
    {
        return  'Автора не существует';
    }

    /**
     * @return string[]
     */
    public static function getAuthorNotFound(): array
    {
        return  ['message' => 'Автор не найден'];
    }

    /**
     * @return string
     */
    public static function getAuthorCreate(): string
    {
        return   'Автор успешно создан';
    }

    /**
     * @return string
     */
    public static function getAuthorSearch(): string
    {
        return   'Автор успешной найден';
    }
}