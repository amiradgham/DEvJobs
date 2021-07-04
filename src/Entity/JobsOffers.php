<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
/**
 * @ORM\Entity(repositoryClass="App\Repository\JobsOffersRepository")
 **/
class JobsOffers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"users"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"users"})
     */
    private $name_offer;

    /**
     * @ORM\Column(type="string", length=550)
     * @Serializer\Groups({"users"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"users"})
     */
    private $post_vacont;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"users"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"users"})
     */
    private $experience;

    /**
     * @ORM\Column(type="date")
     * @Serializer\Groups({"users"}) 
     */
    private $experiation_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Groups({"users"})
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Groups({"users"})
     */
    private $salary;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"users"})
     */
    private $contract_type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country")
     * @Serializer\Groups({"users"})
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"users"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Groups({"users"})
     */
    private $niveau_etude;

    /**
     * @ORM\Column(type="text")
     * @Serializer\Groups({"users"})
     */
    private $mission;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Groups({"users"})
     */
    private $formation_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Groups({"users"})
     */
    private $competence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups({"users"})
     */
    private $created_by;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $update_by;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $deleted_by;

    /**
     * @ORM\Column(type="datetime")
   * @Serializer\Groups({"users"})
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $update_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deleted_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $remove;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Groups({"users"})
     */
    private $picture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameOffer(): ?string
    {
        return $this->name_offer;
    }

    public function setNameOffer(string $name_offer): self
    {
        $this->name_offer = $name_offer;

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

    public function getPostVacont(): ?int
    {
        return $this->post_vacont;
    }

    public function setPostVacont(int $post_vacont): self
    {
        $this->post_vacont = $post_vacont;

        return $this;
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

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getExperiationDate(): ?\DateTimeInterface
    {
        return $this->experiation_date;
    }

    public function setExperiationDate(\DateTimeInterface $experiation_date): self
    {
        $this->experiation_date = $experiation_date;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(?string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getContractType(): ?string
    {
        return $this->contract_type;
    }

    public function setContractType(string $contract_type): self
    {
        $this->contract_type = $contract_type;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getNiveauEtude(): ?string
    {
        return $this->niveau_etude;
    }

    public function setNiveauEtude(?string $niveau_etude): self
    {
        $this->niveau_etude = $niveau_etude;

        return $this;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(string $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getFormationType(): ?string
    {
        return $this->formation_type;
    }

    public function setFormationType(?string $formation_type): self
    {
        $this->formation_type = $formation_type;

        return $this;
    }

    public function getCompetence(): ?string
    {
        return $this->competence;
    }

    public function setCompetence(?string $competence): self
    {
        $this->competence = $competence;

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

    public function getUpdateBy(): ?User
    {
        return $this->update_by;
    }

    public function setUpdateBy(?User $update_by): self
    {
        $this->update_by = $update_by;

        return $this;
    }

    public function getDeletedBy(): ?User
    {
        return $this->deleted_by;
    }

    public function setDeletedBy(?User $deleted_by): self
    {
        $this->deleted_by = $deleted_by;

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

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(?\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?\DateTimeInterface $deleted_at): self
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    public function getRemove(): ?bool
    {
        return $this->remove;
    }

    public function setRemove(?bool $remove): self
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
