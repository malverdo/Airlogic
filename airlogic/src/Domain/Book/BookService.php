<?php

namespace App\Domain\Book;

use App\Infrastructure\Entity\Airlogic\Book;
use App\Infrastructure\Repository\BaseRepository\AbstractDomainService;
use App\Infrastructure\Repository\BaseRepository\Contracts\DomainServiceInterface;
use App\Infrastructure\Repository\Book\BookFlash;
use App\Infrastructure\Repository\Book\BookRepository;
use App\Infrastructure\Service\SerializerService;
use App\Infrastructure\Service\ValidationService;

/**
 *
 */
class BookService extends AbstractDomainService implements DomainServiceInterface
{
    /**
     * @param SerializerService $serializerService
     * @param ValidationService $validationService
     * @param BookRepository $authorRepository
     */
    public function __construct(
        SerializerService $serializerService,
        ValidationService $validationService,
        BookRepository $authorRepository
    ) {
        parent::__construct($serializerService, $validationService, $authorRepository);
    }

    /**
     * @return BookFlash
     */
    public function getFlash(): BookFlash
    {
        return new BookFlash();
    }

    /**
     * @return string
     */
    public function getNameEntity(): string
    {
        return Book::class;
    }

}