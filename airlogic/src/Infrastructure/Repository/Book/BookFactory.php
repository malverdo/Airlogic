<?php
namespace App\Infrastructure\Repository\Book;

use App\Infrastructure\Dto\BookCreateRequestDto;
use App\Infrastructure\Entity\Airlogic\Author;
use App\Infrastructure\Entity\Airlogic\Book;
use App\Infrastructure\Repository\BaseRepository\Contracts\DtoInterface;
use App\Infrastructure\Service\TranslateService;

class BookFactory
{

    public static function bookCreate($name): Book
    {
        $book = new Book();
        $book->setName($name);
        return $book;
    }

    public static function bookAndAuthorCreate(string $name, Author $author): Book
    {
        $book = new Book();
        $book->setName($name);
        $book->setAuthor($author);
        return $book;
    }

    public static function bookCreateDtoAndAuthor(BookCreateRequestDto $dto, Author $author): Book
    {
        $book = new Book();
        $book->setName($dto->name);
        $book->setAuthor($author);
        return $book;
    }
}