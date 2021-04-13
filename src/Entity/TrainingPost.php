<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class TrainingPost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $modalite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $objectif;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $hourly_volume;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $cout;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $service_telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $service_gsm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $service_email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $service_site_web;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adddress;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country")
     */
    private $country;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $end_duration;

    /**
     * @ORM\Column(type="string", length=550, nullable=true)
     */
    private $society_description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

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

    public function getModalite(): ?string
    {
        return $this->modalite;
    }

    public function setModalite(?string $modalite): self
    {
        $this->modalite = $modalite;

        return $this;
    }

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(string $objectif): self
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getHourlyVolume(): ?string
    {
        return $this->hourly_volume;
    }

    public function setHourlyVolume(string $hourly_volume): self
    {
        $this->hourly_volume = $hourly_volume;

        return $this;
    }

    public function getCout(): ?string
    {
        return $this->cout;
    }

    public function setCout(string $cout): self
    {
        $this->cout = $cout;

        return $this;
    }

    public function getServiceTelephone(): ?string
    {
        return $this->service_telephone;
    }

    public function setServiceTelephone(?string $service_telephone): self
    {
        $this->service_telephone = $service_telephone;

        return $this;
    }

    public function getServiceGsm(): ?string
    {
        return $this->service_gsm;
    }

    public function setServiceGsm(?string $service_gsm): self
    {
        $this->service_gsm = $service_gsm;

        return $this;
    }

    public function getServiceEmail(): ?string
    {
        return $this->service_email;
    }

    public function setServiceEmail(?string $service_email): self
    {
        $this->service_email = $service_email;

        return $this;
    }

    public function getServiceSiteWeb(): ?string
    {
        return $this->service_site_web;
    }

    public function setServiceSiteWeb(?string $service_site_web): self
    {
        $this->service_site_web = $service_site_web;

        return $this;
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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAdddress(): ?string
    {
        return $this->adddress;
    }

    public function setAdddress(?string $adddress): self
    {
        $this->adddress = $adddress;

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

    public function getEndDuration(): ?\DateTimeInterface
    {
        return $this->end_duration;
    }

    public function setEndDuration(?\DateTimeInterface $end_duration): self
    {
        $this->end_duration = $end_duration;

        return $this;
    }

    public function getSocietyDescription(): ?string
    {
        return $this->society_description;
    }

    public function setSocietyDescription(?string $society_description): self
    {
        $this->society_description = $society_description;

        return $this;
    }
}
