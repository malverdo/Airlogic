<?php

namespace App\Infrastructure\Repository\Author;

use App\Infrastructure\Dto\AuthorCreateRequestDto;
use App\Infrastructure\Entity\Airlogic\Author;
use App\Infrastructure\Entity\Airlogic\Book;

/**
 *
 */
class AuthorFactory
{
    /**
     * @param string $name
     * @return Author
     */
    public static function authorCreate(string $name): Author
    {
        $author = new Author();
        $author->setName($name);
        return $author;
    }

    /**
     * @param string $name
     * @param Book $book
     * @return Author
     */
    public static function authorBookCreate(string $name, Book $book): Author
    {
        $author = new Author();
        $author->setName($name);
        $author->addBook($book);
        return $author;
    }

    /**
     * @param AuthorCreateRequestDto $dto
     * @return Author
     */
    public static function authorDtoCreate(AuthorCreateRequestDto $dto): Author
    {
        $author = new Author();
        $author->setName($dto->name);
        return $author;
    }

}