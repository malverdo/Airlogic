<?php

namespace App\Domain\Author;

use App\Infrastructure\Entity\Airlogic\Author;
use App\Infrastructure\Exception\InvalidRequestException;
use App\Infrastructure\Repository\Author\AuthorRepository;
use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use App\Infrastructure\Service\SerializerService;
use App\Infrastructure\Service\TranslateService;
use App\Infrastructure\Service\ValidationService;
use Dejurin\GoogleTranslateForFree;

class AuthorService
{

    /**
     * @var SerializerService
     */
    private SerializerService $serializerService;

    /**
     * @var ValidationService
     */
    private ValidationService $validationService;


    /**
     * @var AuthorRepository
     */
    private AuthorRepository $authorRepository;

    private TranslateService $translate;

    /**
     * @param SerializerService $serializerService
     * @param ValidationService $validationService
     */
    public function __construct(
        SerializerService $serializerService,
        ValidationService $validationService,
        AuthorRepository $authorRepository,
        TranslateService $translate
    )
    {
        $this->serializerService = $serializerService;
        $this->validationService = $validationService;
        $this->authorRepository = $authorRepository;
        $this->translate = $translate;
    }

    /**
     * @throws InvalidRequestException
     */
    public function serializerAndValidation($content) :EntityInterface
    {
        $entity = $this->serializerService->getSerializer()->deserialize($content, $this->getNameEntity(), 'json');
        $this->validationService->validator($entity);
        return $entity;
    }

    public function defaultTranslate($text)
    {
        return $this->translate->defaultTranslate($text);
    }

    public function save(Author $author)
    {
        $this->authorRepository->save($author);
    }

    public function getNameEntity(): string
    {
        return Author::class;
    }
}