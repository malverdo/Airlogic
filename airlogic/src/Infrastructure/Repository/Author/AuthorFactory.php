<?php

namespace App\Infrastructure\Repository\Author;

use App\Entity\Airlogic\Author;
use App\Entity\Airlogic\Book;

class AuthorFactory
{
    public static function authorCreate(string $name): Author
    {
        $author = new Author();
        $author->setName($name);
        return $author;
    }

    public static function authorBookCreate(string $name, Book $book): Author
    {
        $author = new Author();
        $author->setName($name);
        $author->addBook($book);
        return $author;
    }


}