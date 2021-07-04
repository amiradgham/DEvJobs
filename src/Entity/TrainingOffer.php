<?php

namespace App\Entity;

use App\Repository\TrainingOfferRepository;
use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Expose;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity(repositoryClass=TrainingOfferRepository::class)
 */
class TrainingOffer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $traningName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $trainingDescription;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $trainingModality;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $trainingObjectif;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $hourlyVolume;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $traningCost;

    /**
     * @ORM\Column(type="string", length=50)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $trainingDuration;


    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $updatedBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $removedBy;

    /**
     * @ORM\Column(type="datetime")
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Sector::class)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $sector;

    /**
     * @ORM\Column(type="boolean")
     */
    private $remove;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTraningName(): ?string
    {
        return $this->traningName;
    }

    public function setTraningName(string $traningName): self
    {
        $this->traningName = $traningName;

        return $this;
    }

    public function getTrainingDescription(): ?string
    {
        return $this->trainingDescription;
    }

    public function setTrainingDescription(string $trainingDescription): self
    {
        $this->trainingDescription = $trainingDescription;

        return $this;
    }

    public function getTrainingModality(): ?string
    {
        return $this->trainingModality;
    }

    public function setTrainingModality(?string $trainingModality): self
    {
        $this->trainingModality = $trainingModality;

        return $this;
    }

    public function getTrainingObjectif(): ?string
    {
        return $this->trainingObjectif;
    }

    public function setTrainingObjectif(?string $trainingObjectif): self
    {
        $this->trainingObjectif = $trainingObjectif;

        return $this;
    }

    public function getHourlyVolume(): ?string
    {
        return $this->hourlyVolume;
    }

    public function setHourlyVolume(?string $hourlyVolume): self
    {
        $this->hourlyVolume = $hourlyVolume;

        return $this;
    }

    public function getTraningCost(): ?string
    {
        return $this->traningCost;
    }

    public function setTraningCost(?string $traningCost): self
    {
        $this->traningCost = $traningCost;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getTrainingDuration(): ?string
    {
        return $this->trainingDuration;
    }

    public function setTrainingDuration(?string $trainingDuration): self
    {
        $this->trainingDuration = $trainingDuration;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getRemovedBy(): ?User
    {
        return $this->removedBy;
    }

    public function setRemovedBy(?User $removedBy): self
    {
        $this->removedBy = $removedBy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getSector(): ?Sector
    {
        return $this->sector;
    }

    public function setSector(?Sector $sector): self
    {
        $this->sector = $sector;

        return $this;
    }

    public function getRemove(): ?bool
    {
        return $this->remove;
    }

    public function setRemove(bool $remove): self
    {
        $this->remove = $remove;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
