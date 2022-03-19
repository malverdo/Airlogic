<?php

namespace App\Domain\Author;

use App\Infrastructure\Entity\Airlogic\Author;
use App\Infrastructure\Repository\Author\AuthorRepository;
use App\Infrastructure\Repository\BaseRepository\AbstractDomainService;
use App\Infrastructure\Repository\BaseRepository\Contracts\DomainServiceInterface;
use App\Infrastructure\Service\SerializerService;
use App\Infrastructure\Service\TranslateService;
use App\Infrastructure\Service\ValidationService;

class AuthorService extends AbstractDomainService implements DomainServiceInterface
{

    public function __construct(
        SerializerService $serializerService,
        ValidationService $validationService,
        TranslateService $translate,
        AuthorRepository $authorRepository
    ) {
        parent::__construct($serializerService, $validationService, $translate, $authorRepository);
    }


    public function getNameEntity(): string
    {
        return Author::class;
    }

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