<?php

declare(strict_types=1);

namespace OpenClassroomsCourse\PlatformBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="OpenClassroomsCourse\PlatformBundle\Repository\AdvertRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Advert
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var Author
     *
     * @ORM\ManyToOne(targetEntity="OpenClassroomsCourse\PlatformBundle\Entity\Author", inversedBy="adverts", fetch="EAGER")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @var Image
     *
     * @ORM\ManyToOne(targetEntity="OpenClassroomsCourse\PlatformBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

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
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }

    /**
     * @param Author $author
     *
     * @return Advert
     */
    public function setAuthor(Author $author): Advert
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     *
     * @return Advert
     */
    public function setImage(Image $image): Advert
    {
        $this->image = $image;

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
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $date
     *
     * @return Advert
     */
    public function setCreatedAt(DateTime $createdAt): Advert
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return Advert
     */
    public function setUpdatedAt(DateTime $updatedAt): Advert
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setPrePersistValues()
    {
        $this
            ->setCreatedAt(new DateTime())
            ->setUpdatedAt($this->createdAt);
    }

    /**
     * @ORM\PreUpdate()
     */
    public function setPreUpdateValues()
    {
        $this->setUpdatedAt(new DateTime());
    }
}
