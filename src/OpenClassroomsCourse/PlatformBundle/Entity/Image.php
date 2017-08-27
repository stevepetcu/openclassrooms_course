<?php

namespace OpenClassroomsCourse\PlatformBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="OpenClassroomsCourse\PlatformBundle\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="low_resolution_url", type="string", length=500)
     */
    private $lowResolutionUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="high_resolution_url", type="string", length=500)
     */
    private $highResolutionUrl;

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
     * @return Image
     */
    public function setId(int $id): Image
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt(string $alt): Image
    {
        $this->alt = $alt;

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
     * @return Image
     */
    public function setTitle(string $title): Image
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getLowResolutionUrl(): string
    {
        return $this->lowResolutionUrl;
    }

    /**
     * @param string $lowResolutionUrl
     *
     * @return Image
     */
    public function setLowResolutionUrl(string $lowResolutionUrl): Image
    {
        $this->lowResolutionUrl = $lowResolutionUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getHighResolutionUrl(): string
    {
        return $this->highResolutionUrl;
    }

    /**
     * @param string $highResolutionUrl
     *
     * @return Image
     */
    public function setHighResolutionUrl(string $highResolutionUrl): Image
    {
        $this->highResolutionUrl = $highResolutionUrl;

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
     * @param DateTime $createdAt
     *
     * @return Image
     */
    public function setCreatedAt(DateTime $createdAt): Image
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
     * @return Image
     */
    public function setUpdatedAt(DateTime $updatedAt): Image
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