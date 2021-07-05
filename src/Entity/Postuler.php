<?php

namespace App\Entity;

use App\Repository\PostulerRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=PostulerRepository::class)
 */
class Postuler
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Serializer\Groups({"users"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Serializer\Groups({"users"})
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     *  @Serializer\Groups({"users"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     *  @Serializer\Groups({"users"})
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=Informaticien::class)
     *  @Serializer\Groups({"users"})
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=JobsOffers::class)
     *  @Serializer\Groups({"users"})
     */
    private $offerId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getEntreprise(): ?User
    {
        return $this->entreprise;
    }

    public function setEntreprise(?User $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getCreatedBy(): ?Informaticien
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?Informaticien $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getOfferId(): ?JobsOffers
    {
        return $this->offerId;
    }

    public function setOfferId(?JobsOffers $offerId): self
    {
        $this->offerId = $offerId;

        return $this;
    }
}
