<?php

namespace App\Infrastructure\Controller;

use App\Domain\Author\AuthorService;
use App\Infrastructure\Exception\InvalidRequestException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AuthorController extends AbstractController
{

    /**
     * @var AuthorService
     */
    private AuthorService $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * @throws InvalidRequestException
     */
    public function create(Request $request): array
    {
        $author = $this->authorService->serializerAndValidation($request->getContent());
        $author->setName($this->authorService->defaultTranslate($author->getName()));
        $this->authorService->save($author);

        return [
            'text' => 'Автор успешно создан',
            'id' => $author->getId(),
            'name' => $author->getName()
        ];
    }
}