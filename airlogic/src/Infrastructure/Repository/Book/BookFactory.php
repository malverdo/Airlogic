<?php
namespace App\Infrastructure\Repository\Book;

use App\Infrastructure\Entity\Airlogic\Author;
use App\Infrastructure\Entity\Airlogic\Book;

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
}