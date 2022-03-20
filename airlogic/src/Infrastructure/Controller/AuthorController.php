<?php

namespace App\Infrastructure\Controller;

use App\Domain\Author\AuthorService;
use App\Infrastructure\Dto\AuthorCreateRequestDto;
use App\Infrastructure\Exception\InvalidRequestException;
use App\Infrastructure\Repository\Author\AuthorFactory;
use App\Infrastructure\Repository\Author\AuthorFlash;
use App\Infrastructure\Repository\Author\AuthorRepository;
use App\Infrastructure\Service\TranslateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class AuthorController extends AbstractController
{

    /**
     * @var AuthorService
     */
    private AuthorService $authorService;
    /**
     * @var AuthorRepository
     */
    private AuthorRepository $authorRepository;
    /**
     * @var TranslateService
     */
    private TranslateService $translate;

    /**
     * @param AuthorService $authorService
     * @param AuthorRepository $authorRepository
     * @param TranslateService $translate
     */
    public function __construct(
        AuthorService $authorService,
        AuthorRepository $authorRepository,
        TranslateService $translate
    ) {
        $this->authorService = $authorService;
        $this->authorRepository = $authorRepository;
        $this->translate = $translate;
    }

    /**
     * @throws InvalidRequestException
     */
    public function create(Request $request): array
    {
        $authorCreateRequestDto = $this->authorService->serializerAndValidation($request->getContent(), AuthorCreateRequestDto::class);
        $author = AuthorFactory::authorDtoCreate($authorCreateRequestDto);
        $author->setName($this->translate->defaultTranslate($author->getName()));
        $this->authorService->save($author);

        return [
            'text' => AuthorFlash::getAuthorCreate(),
            'author' => json_decode($this->authorService->serializer($author))
        ];
    }

    /**
     * @param Request $request
     * @return array[]
     */
    public function search(Request $request): array
    {
        $name = $request->query->get('name');
        if ($name) {
            $authors = $this->authorRepository->findLikeName($name);
            $authorsResponse = [];
            foreach ($authors as $author) {
                $authorsResponse[] = json_decode($this->authorService->serializer($author));
            }
            return [
                'authors' => $authorsResponse ?: AuthorFlash::getAuthorNotFound()
            ];
        }
        return [];
    }
}