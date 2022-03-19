<?php

namespace App\Infrastructure\Controller;


use App\Domain\Book\BookService;
use App\Infrastructure\Exception\InvalidRequestException;
use App\Infrastructure\Repository\Author\AuthorRepository;
use App\Infrastructure\Repository\BaseRepository\Exception\NotFoundException;
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

    private BookRepository $bookRepository;

    public function __construct(
        BookService $bookService,
        AuthorRepository $authorRepository,
        BookRepository $bookRepository
    ) {
        $this->bookService = $bookService;
        $this->authorRepository = $authorRepository;
        $this->bookRepository = $bookRepository;
    }

    /**
     * @throws InvalidRequestException
     * @throws NotFoundException
     */
    public function create(Request $request): array
    {
        $book = $this->bookService->serializerAndValidation($request->getContent());
        $author = $this->authorRepository->findId($book->getAuthorId(),  $this->bookService->getFlash());
        $book->setName($this->bookService->defaultTranslate($book->getName()));
        $book->setAuthor($author);
        $this->bookService->save($book);

        return [
            'text' => 'Книга успешно создана',
            'id' => $book->getId(),
            'name' => $book->getName(),
            'author' => [
                'id' => $book->getAuthor()->getId(),
                'name' => $book->getAuthor()->getName(),
            ],
        ];
    }


    public function search(Request $request): array
    {

    }
}