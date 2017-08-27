<?php

declare(strict_types=1);

namespace OpenClassroomsCourse\PlatformBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="author")
 * @ORM\Entity(repositoryClass="OpenClassroomsCourse\PlatformBundle\Repository\AuthorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Author
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
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255)
     */
    private $website;

    /**
     * @var Advert
     *
     * @ORM\OneToMany(targetEntity="OpenClassroomsCourse\PlatformBundle\Entity\Advert", mappedBy="author")
     */
    private $adverts;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Author
     */
    public function setFirstName(string $firstName): Author
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Author
     */
    public function setLastName(string $lastName): Author
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Author
     */
    public function setEmail(string $email): Author
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Author
     */
    public function setWebsite(string $website): Author
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     *
     * @return Author
     */
    public function setCreatedAt(DateTime $createdAt): Author
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Advert
     */
    public function getAdverts(): Advert
    {
        return $this->adverts;
    }

    /**
     * @param Advert $adverts
     *
     * @return Author
     */
    public function setAdverts(Advert $adverts): Author
    {
        $this->adverts = $adverts;
        return $this;
    }

    /**
     * Set updatedAt
     *
     * @param DateTime $updatedAt
     *
     * @return Author
     */
    public function setUpdatedAt(DateTime $updatedAt): Author
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
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

