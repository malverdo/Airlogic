<?php

namespace App\Infrastructure\Repository\Book;

use App\Infrastructure\Entity\Airlogic\Book;
use App\Infrastructure\Repository\BaseRepository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

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


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($this->getBD(), $this->getEntityName(), $registry);
    }


}