<?php

namespace App\Infrastructure\Repository\BaseRepository;


use App\Infrastructure\Entity\Airlogic\Author;
use App\Infrastructure\Exception\InvalidRequestException;
use App\Infrastructure\Repository\BaseRepository\Contracts\DtoInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryInterface;
use App\Infrastructure\Service\SerializerService;
use App\Infrastructure\Service\TranslateService;
use App\Infrastructure\Service\ValidationService;

abstract class AbstractDomainService
{
    /**
     * @var SerializerService
     */
    protected SerializerService $serializerService;

    /**
     * @var ValidationService
     */
    protected ValidationService $validationService;


    /**
     * @var RepositoryInterface
     */
    protected RepositoryInterface $repository;

    protected TranslateService $translate;

    /**
     * @param SerializerService $serializerService
     * @param ValidationService $validationService
     */
    public function __construct(
        SerializerService $serializerService,
        ValidationService $validationService,
        TranslateService $translate,
        RepositoryInterface $repository
    ) {
        $this->serializerService = $serializerService;
        $this->validationService = $validationService;
        $this->repository = $repository;
        $this->translate = $translate;
    }

    /**
     * @throws InvalidRequestException
     */
    public function serializerAndValidation($content, $dtoRequest = null)
    {
        $dto = $this->serializerService->getSerializer()->deserialize($content, $dtoRequest , 'json');
        $this->validationService->validator($dto);
        return $dto;
    }

    /**
     */
    public function serializer($content) : string
    {
        return $this->serializerService->getSerializer()->serialize($content, 'json' );
    }

    public function defaultTranslate($text)
    {
        return $this->translate->defaultTranslate($text);
    }

    public function save(EntityInterface $author)
    {
        $this->repository->save($author);
    }
}