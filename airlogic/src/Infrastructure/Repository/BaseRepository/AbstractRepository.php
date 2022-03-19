<?php

namespace App\Infrastructure\Repository\BaseRepository;

use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class AbstractRepository extends ServiceEntityRepository implements RepositoryInterface
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
}