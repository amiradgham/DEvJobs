<?php

namespace App\Entity;
use Webmozart\Assert\Assert;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InformaticienRepository")
 */
class Informaticien
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $bio;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $contratType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $experience;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $cv;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $recieveNotification;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $created_by;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $updated_by;

    /**
     * @ORM\Column(type="datetime")
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getContratType(): ?string
    {
        return $this->contratType;
    }

    public function setContratType(?string $contratType): self
    {
        $this->contratType = $contratType;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getRecieveNotification(): ?bool
    {
        return $this->recieveNotification;
    }

    public function setRecieveNotification(?bool $recieveNotification): self
    {
        $this->recieveNotification = $recieveNotification;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updated_by;
    }

    public function setUpdatedBy(?User $updated_by): self
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
