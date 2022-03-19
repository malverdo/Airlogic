<?php

namespace App\Infrastructure\Entity\Airlogic;


use App\Infrastructure\Repository\BaseRepository\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use JMS\Serializer\Annotation\Exclude;


/**
 * @Entity
 * @Table(name="book")
 */
class Book extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;


    /**
     * @ORM\Column(type="text")
     */
    private string $name;

    /**
     *
     * Many features have one product. This is the owning side.
     * @ManyToOne(targetEntity="App\Infrastructure\Entity\Airlogic\Author", inversedBy="books")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     */
    private Author $author;





    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }

    /**
     * @param Author $author
     */
    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }



}