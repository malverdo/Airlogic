<?php

namespace App\Infrastructure\Controller;

use App\Domain\Author\AuthorService;
use App\Infrastructure\Dto\AuthorCreateRequestDto;
use App\Infrastructure\Exception\InvalidRequestException;
use App\Infrastructure\Repository\Author\AuthorFactory;
use App\Infrastructure\Repository\Author\AuthorFlash;
use App\Infrastructure\Repository\Author\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AuthorController extends AbstractController
{

    /**
     * @var AuthorService
     */
    private AuthorService $authorService;
    private AuthorRepository $authorRepository;

    public function __construct(AuthorService $authorService, AuthorRepository $authorRepository)
    {
        $this->authorService = $authorService;
        $this->authorRepository = $authorRepository;
    }

    /**
     * @throws InvalidRequestException
     */
    public function create(Request $request): array
    {
        $authorCreateRequestDto = $this->authorService->serializerAndValidation($request->getContent(), AuthorCreateRequestDto::class);
        $author = AuthorFactory::authorDtoCreate($authorCreateRequestDto);
        $author->setName($this->authorService->defaultTranslate($author->getName()));
        $this->authorService->save($author);

        return [
            'text' => AuthorFlash::getAuthorCreate(),
            'author' => json_decode($this->authorService->serializer($author))
        ];
    }

    public function search(Request $request): array
    {
        $name = $request->query->get('name');
        $author = $this->authorRepository->findLikeName($name);
        $authors = [];
        foreach ($author as $value) {
            $authors[] = json_decode($this->authorService->serializer($value));
        }

        return [
            'authors' => $authors ?: AuthorFlash::getAuthorNotFound()
        ];
    }
}