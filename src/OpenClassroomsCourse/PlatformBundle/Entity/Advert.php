<?php

declare(strict_types=1);

namespace OpenClassroomsCourse\PlatformBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @package OpenClassroomsCourse\PlatformBundle\Entity
 */
class Advert
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="auto")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     *
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(name="author", type="string", length=255)
     *
     * @var string
     */
    private $author;

    /**
     * @ORM\Column(name="content", type="text")
     *
     * @var string
     */
    private $content;

    /**
     * @ORM\Column(name="date", type="date")
     *
     * @var DateTime
     */
    private $date;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Advert
     */
    public function setId(int $id): Advert
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Advert
     */
    public function setTitle(string $title): Advert
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     *
     * @return Advert
     */
    public function setAuthor(string $author): Advert
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return Advert
     */
    public function setContent(string $content): Advert
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     *
     * @return Advert
     */
    public function setDate(DateTime $date): Advert
    {
        $this->date = $date;
        return $this;
    }
}
