<?php

namespace App\Entity;

use App\Repository\SpaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=SpaRepository::class)
 * @Vich\Uploadable
 */
class Spa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_courte;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fiche_soin;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_enregistrement;

    /**
     * @ORM\OneToMany(targetEntity=CommandeSpa::class, mappedBy="id_spa")
     */
    private $commandeSpas;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modification;

    /**
     * @Vich\UploadableField(mapping="spa", fileNameProperty="fiche_soin")
     */
    private $imageFile;

    public function __construct()
    {
        $this->commandeSpas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescriptionCourte(): ?string
    {
        return $this->description_courte;
    }

    public function setDescriptionCourte(string $description_courte): self
    {
        $this->description_courte = $description_courte;

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

    public function getFicheSoin(): ?string
    {
        return $this->fiche_soin;
    }

    public function setFicheSoin(?string $fiche_soin): self
    {
        $this->fiche_soin = $fiche_soin;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $date_enregistrement): self
    {
        $this->date_enregistrement = $date_enregistrement;

        return $this;
    }

    /**
     * @return Collection<int, CommandeSpa>
     */
    public function getCommandeSpas(): Collection
    {
        return $this->commandeSpas;
    }

    public function addCommandeSpa(CommandeSpa $commandeSpa): self
    {
        if (!$this->commandeSpas->contains($commandeSpa)) {
            $this->commandeSpas[] = $commandeSpa;
            $commandeSpa->setIdSpa($this);
        }

        return $this;
    }

    public function removeCommandeSpa(CommandeSpa $commandeSpa): self
    {
        if ($this->commandeSpas->removeElement($commandeSpa)) {
            // set the owning side to null (unless already changed)
            if ($commandeSpa->getIdSpa() === $this) {
                $commandeSpa->setIdSpa(null);
            }
        }

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->date_modification;
    }

    public function setDateModification(\DateTimeInterface $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;

        if($this->imageFile instanceof UploadedFile)
        {
            $this->date_modification = new \DateTime;
        }

        return $this;
    }
}
