<?php

namespace App\Domain\Author;

use App\Infrastructure\Entity\Airlogic\Author;
use App\Infrastructure\Repository\Author\AuthorRepository;
use App\Infrastructure\Repository\BaseRepository\AbstractDomainService;
use App\Infrastructure\Repository\BaseRepository\Contracts\DomainServiceInterface;
use App\Infrastructure\Service\SerializerService;
use App\Infrastructure\Service\ValidationService;

/**
 *
 */
class AuthorService extends AbstractDomainService implements DomainServiceInterface
{

    /**
     * @param SerializerService $serializerService
     * @param ValidationService $validationService
     * @param AuthorRepository $authorRepository
     */
    public function __construct(
        SerializerService $serializerService,
        ValidationService $validationService,
        AuthorRepository $authorRepository
    ) {
        parent::__construct($serializerService, $validationService, $authorRepository);
    }


    /**
     * @return string
     */
    public function getNameEntity(): string
    {
        return Author::class;
    }

    /**
     * @param array $books
     * @return array
     */
    public function builderBook(array $books): array
    {
        $arrayBooks = [];
        foreach ($books as $book) {
            $arrayBooks[] = [
                'id' => $book->getId(),
                'name' => $book->getName()
            ];
        }
        return $arrayBooks;
    }
}