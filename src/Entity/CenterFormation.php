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
 * @ORM\Entity(repositoryClass="App\Repository\CenterFormationRepository")
 */
class CenterFormation
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
    private $secteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $bio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $exeprience;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Expose
     * @Serializer\Groups({"users","admin"})
     */
    private $created_by;

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

    public function getSecteur(): ?string
    {
        return $this->secteur;
    }

    public function setSecteur(?string $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
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

    public function getExeprience(): ?string
    {
        return $this->exeprience;
    }

    public function setExeprience(?string $exeprience): self
    {
        $this->exeprience = $exeprience;

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
