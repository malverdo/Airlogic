<?php

namespace App\Tests\Create;

use App\Infrastructure\Dto\AuthorCreateRequestDto;
use App\Infrastructure\Exception\InvalidRequestException;
use App\Infrastructure\Repository\Author\AuthorFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AuthorCreateTest  extends KernelTestCase
{


    /**
     * @dataProvider additionProvider
     * @throws InvalidRequestException
     */
    public function testCreateAuthor($name, $authorId)
    {
        $container = static::getContainer();
        $bookService = $container->get('App\Domain\Book\BookService');

        $request = json_encode([
            "name" => $name,
            "author_id" => $authorId
        ]);

        $authorCreateRequestDto = $bookService->serializerAndValidation($request, AuthorCreateRequestDto::class);
        $this->assertNotEmpty($authorCreateRequestDto);
        $this->assertSame($authorCreateRequestDto->name, $name);

        $author = AuthorFactory::authorDtoCreate($authorCreateRequestDto);
        $this->assertNotEmpty($author);
        $this->assertSame($author->getName(), $name);
    }

    public function additionProvider(): array
    {
        return [
            [
                "name" => "Джек",
                "author_id" => 1
            ]
        ];
    }
}