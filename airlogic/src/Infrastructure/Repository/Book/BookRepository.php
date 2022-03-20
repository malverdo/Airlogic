<?php

namespace App\Infrastructure\Repository\Book;

use App\Infrastructure\Entity\Airlogic\Book;
use App\Infrastructure\Repository\BaseRepository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Infrastructure\Repository\Book\BookFlash;

class BookRepository extends  AbstractRepository
{
    public function getEntityName(): string
    {
        return Book::class;
    }

    public function getBD(): string
    {
        return 'airlogic';
    }

    public function getTableAlias(): string
    {
        return 'a';
    }

    public function getFlash(): BookFlash
    {
        return new BookFlash();
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($this->getBD(), $this->getEntityName(), $registry);
    }


}