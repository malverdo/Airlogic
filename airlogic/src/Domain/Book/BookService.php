<?php

namespace App\Domain\Book;

use App\Infrastructure\Entity\Airlogic\Book;
use App\Infrastructure\Repository\Author\AuthorFlash;
use App\Infrastructure\Repository\BaseRepository\AbstractDomainService;
use App\Infrastructure\Repository\BaseRepository\Contracts\DomainServiceInterface;
use App\Infrastructure\Repository\Book\BookRepository;
use App\Infrastructure\Service\SerializerService;
use App\Infrastructure\Service\TranslateService;
use App\Infrastructure\Service\ValidationService;

class BookService extends AbstractDomainService implements DomainServiceInterface
{
    public function __construct(
        SerializerService $serializerService,
        ValidationService $validationService,
        BookRepository $authorRepository
    ) {
        parent::__construct($serializerService, $validationService, $authorRepository);
    }

    public function getFlash(): AuthorFlash
    {
        return new AuthorFlash();
    }

    public function getNameEntity(): string
    {
        return Book::class;
    }

}