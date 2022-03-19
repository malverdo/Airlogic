<?php

namespace App\DataFixtures;

use App\Entity\Airlogic\Author;

use App\Entity\Airlogic\Book;
use App\Infrastructure\Repository\Author\AuthorFactory;
use App\Infrastructure\Repository\Book\BookFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;



class AuthorBookAppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $factory = Factory::create('ru_RU');
        for ($i = 1; $i <= 10000; $i++) {
            $book = BookFactory::bookCreate($factory->realText(40));
            $author = AuthorFactory::authorBookCreate($factory->name, $book);
            $manager->persist($author);
        }
        $manager->flush();
    }
}
