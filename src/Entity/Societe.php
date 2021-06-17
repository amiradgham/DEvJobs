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
 * @ORM\Entity(repositoryClass="App\Repository\SocieteRepository")
 */
class Societe
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
     * @ORM\Column(type="string", length=255)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $website;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $nb_emp;

    /**
     * @ORM\Column(type="string", length=255)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $secteur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $nbAbonne;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $nbAnnonce;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

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

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getNbEmp(): ?int
    {
        return $this->nb_emp;
    }

    public function setNbEmp(?int $nb_emp): self
    {
        $this->nb_emp = $nb_emp;

        return $this;
    }

    public function getSecteur(): ?string
    {
        return $this->secteur;
    }

    public function setSecteur(string $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getNbAbonne(): ?int
    {
        return $this->nbAbonne;
    }

    public function setNbAbonne(?int $nbAbonne): self
    {
        $this->nbAbonne = $nbAbonne;

        return $this;
    }

    public function getNbAnnonce(): ?int
    {
        return $this->nbAnnonce;
    }

    public function setNbAnnonce(?int $nbAnnonce): self
    {
        $this->nbAnnonce = $nbAnnonce;

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
