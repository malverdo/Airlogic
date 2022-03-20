<?php

namespace App\Infrastructure\Repository\Book;

use App\Infrastructure\Entity\Airlogic\Book;
use App\Infrastructure\Repository\BaseRepository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Infrastructure\Repository\Book\BookFlash;

/**
 *
 */
class BookRepository extends  AbstractRepository
{
    /**
     * @return string
     */
    public function getEntityName(): string
    {
        return Book::class;
    }

    /**
     * @return string
     */
    public function getBD(): string
    {
        return 'airlogic';
    }

    /**
     * @return string
     */
    public function getTableAlias(): string
    {
        return 'a';
    }

    /**
     * @return \App\Infrastructure\Repository\Book\BookFlash
     */
    public function getFlash(): BookFlash
    {
        return new BookFlash();
    }

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($this->getBD(), $this->getEntityName(), $registry);
    }


}