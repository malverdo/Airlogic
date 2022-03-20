<?php

namespace App\Infrastructure\Controller;


use App\Domain\Book\BookService;
use App\Infrastructure\Dto\BookCreateRequestDto;
use App\Infrastructure\Exception\InvalidRequestException;
use App\Infrastructure\Repository\Author\AuthorRepository;
use App\Infrastructure\Repository\BaseRepository\Exception\NotFoundException;
use App\Infrastructure\Repository\Book\BookFactory;
use App\Infrastructure\Repository\Book\BookFlash;
use App\Infrastructure\Repository\Book\BookRepository;
use App\Infrastructure\Service\TranslateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class BookController extends AbstractController
{
    /**
     * @var BookService
     */
    private BookService $bookService;

    /**
     * @var AuthorRepository
     */
    private AuthorRepository $authorRepository;
    /**
     * @var BookRepository
     */
    private BookRepository $bookRepository;

    /**
     * @var TranslateService
     */
    private TranslateService $translate;

    /**
     * @param BookService $bookService
     * @param AuthorRepository $authorRepository
     * @param BookRepository $bookRepository
     * @param TranslateService $translate
     */
    public function __construct(
        BookService $bookService,
        AuthorRepository $authorRepository,
        BookRepository $bookRepository,
        TranslateService $translate
    ) {
        $this->bookService = $bookService;
        $this->authorRepository = $authorRepository;
        $this->bookRepository = $bookRepository;
        $this->translate = $translate;
    }

    /**
     * @throws InvalidRequestException
     * @throws NotFoundException
     */
    public function create(Request $request): array
    {
        $bookCreateRequestDto = $this->bookService->serializerAndValidation($request->getContent(), BookCreateRequestDto::class);
        $author = $this->authorRepository->findId($bookCreateRequestDto->authorId, true);
        $book = BookFactory::bookCreateDtoAndAuthor($bookCreateRequestDto, $author);
        $book->setName($this->translate->defaultTranslate($book->getName()));
        $this->bookService->save($book);

        return [
            'text' => BookFlash::getBookCreate(),
            'book' => json_decode($this->bookService->serializer($book))
        ];
    }

    /**
     * @throws NotFoundException
     */
    public function bookInfoId(Request $request, int $id): array
    {
        $book = $this->bookRepository->findId($id, true);
        return [
            'book' => json_decode($this->bookService->serializer($book))
        ];
    }

}