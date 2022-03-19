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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BookController extends AbstractController
{
    /**
     * @var BookService
     */
    private BookService $bookService;

    private AuthorRepository $authorRepository;

    public function __construct(
        BookService $bookService,
        AuthorRepository $authorRepository
    ) {
        $this->bookService = $bookService;
        $this->authorRepository = $authorRepository;
    }

    /**
     * @throws InvalidRequestException
     * @throws NotFoundException
     */
    public function create(Request $request): array
    {
        $bookCreateRequestDto = $this->bookService->serializerAndValidation($request->getContent(), BookCreateRequestDto::class);
        $author = $this->authorRepository->findId($bookCreateRequestDto->authorId,  $this->bookService->getFlash());
        $book = BookFactory::bookCreateDtoAndAuthor($bookCreateRequestDto, $author);
        $book->setName($this->bookService->defaultTranslate($book->getName()));
        $this->bookService->save($book);

        return [
            'text' => 'Книга успешно создана',
            'book' => json_decode($this->bookService->serializer($book))
        ];
    }

}