<?php

namespace App\Infrastructure\Entity\Airlogic;

use App\Domain\Author\Contract\AuthorEntityInterface;
use App\Infrastructure\Repository\BaseRepository\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use JMS\Serializer\Annotation\Accessor;

/**
 * @Entity
 * @Table(name="author")
 * @Entity(repositoryClass="App\Infrastructure\Repository\Author\AuthorRepository")
 */
class Author extends AbstractEntity implements AuthorEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="text")
     * @Accessor(getter="getLocaleName")
     */
    private string $name;

    public function getLocaleName(): string
    {
        return isset($_ENV['LOCALE']) ? $this->getTranslate()->translate($_ENV['LOCALE'], $this->name) : $this->name;
    }

    /**
     *
     * @OneToMany(targetEntity="App\Infrastructure\Entity\Airlogic\Book", mappedBy="author", cascade={"persist"})
     */
    private object $books;

    public function __construct() {
        $this->books = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAuthor($this);
        }

        return $this;
    }

    public function removeBook(Book $books): self
    {
        if ($this->books->removeElement($books)) {
            if ($books->getAuthor() === $this) {
                $books->setAuthor(null);
            }
        }
        return $this;
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