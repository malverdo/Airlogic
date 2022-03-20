<?php

namespace App\Infrastructure\Repository\Author;



use App\Domain\Author\Contract\AuthorRepositoryInterface;
use App\Infrastructure\Repository\BaseRepository\AbstractRepository;
use App\Infrastructure\Entity\Airlogic\Author;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 */
class AuthorRepository  extends  AbstractRepository implements AuthorRepositoryInterface
{
    /**
     * @return string
     */
    public function getEntityName(): string
    {
        return Author::class;
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
     * @return AuthorFlash
     */
    public function getFlash(): AuthorFlash
    {
        return new AuthorFlash();
    }

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($this->getBD(), $this->getEntityName(), $registry);
    }


}