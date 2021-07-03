<?php

namespace App\Entity;

use App\Repository\StageFormationRepository;
use Webmozart\Assert\Assert;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=StageFormationRepository::class)
 */
class StageFormation
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
     * @ORM\Column(type="string", length=255)
     *  @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $nom_sujet;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     *  @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $postVacon;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $technology;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $competence;

    /**
     * @ORM\Column(type="date", nullable=true)
     *  @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $dateExperation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     *  @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $createdBy;

    /**
     * @ORM\Column(type="boolean")
     *  @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $remove;

    /**
     * @ORM\Column(type="datetime")
     *  @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSujet(): ?string
    {
        return $this->nom_sujet;
    }

    public function setNomSujet(string $nom_sujet): self
    {
        $this->nom_sujet = $nom_sujet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPostVacon(): ?int
    {
        return $this->postVacon;
    }

    public function setPostVacon(int $postVacon): self
    {
        $this->postVacon = $postVacon;

        return $this;
    }

    public function getTechnology(): ?string
    {
        return $this->technology;
    }

    public function setTechnology(string $technology): self
    {
        $this->technology = $technology;

        return $this;
    }

    public function getCompetence(): ?string
    {
        return $this->competence;
    }

    public function setCompetence(string $competence): self
    {
        $this->competence = $competence;

        return $this;
    }

    public function getDateExperation(): ?\DateTimeInterface
    {
        return $this->dateExperation;
    }

    public function setDateExperation(?\DateTimeInterface $dateExperation): self
    {
        $this->dateExperation = $dateExperation;

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

    public function getRemove(): ?bool
    {
        return $this->remove;
    }

    public function setRemove(bool $remove): self
    {
        $this->remove = $remove;

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
}
