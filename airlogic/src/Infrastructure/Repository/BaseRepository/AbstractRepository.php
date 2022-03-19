<?php

namespace App\Infrastructure\Repository\BaseRepository;

use App\Infrastructure\Repository\Author\AuthorFlash;
use App\Infrastructure\Repository\BaseRepository\Contracts\AuthorInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\FlashInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryInterface;
use App\Infrastructure\Repository\BaseRepository\Exception\NotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

abstract class AbstractRepository extends ServiceEntityRepository implements RepositoryInterface
{

    public ObjectManager $managerRegistry;

    public function __construct(string $nameDb, string $entityClass, ManagerRegistry $registry)
    {
        $this->managerRegistry = $registry->getManager($nameDb);
        parent::__construct($registry, $entityClass);
    }

    public function save(EntityInterface $entity)
    {
        $this->managerRegistry->persist($entity);
        $this->managerRegistry->flush();
    }

    /**
     * @throws NotFoundException
     */
    public function flashException(FlashInterface $flash)
    {
        throw new NotFoundException($flash->getMiss());
    }


    /**
     * @throws NotFoundException
     */
    public function findId($id, FlashInterface $flash = null, $lockMode = null, $lockVersion = null)
    {
        $entity = $this->find($id, $lockMode, $lockVersion);
        if (!$entity && $flash) {
            $this->flashException($flash);
        }
        return $entity;
    }

    public function findLikeName(string $name)
    {
        $createQueryBuilder = $this->createQueryBuilder($this->getTableAlias())
            ->where($this->getTableAlias() . '.name LIKE :name')
            ->orderBy($this->getTableAlias() . '.id', 'ASC')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery();

        return $createQueryBuilder->getResult();
    }
}