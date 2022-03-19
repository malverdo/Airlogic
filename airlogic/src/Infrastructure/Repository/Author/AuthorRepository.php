<?php

namespace App\Infrastructure\Repository\Author;


use App\Infrastructure\Repository\BaseRepository\AbstractRepository;
use App\Infrastructure\Entity\Airlogic\Author;
use Doctrine\Persistence\ManagerRegistry;

class AuthorRepository  extends  AbstractRepository
{
    public function getEntityName(): string
    {
        return Author::class;
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