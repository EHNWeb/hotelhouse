<?php

namespace App\Entity;

use App\Repository\CommandeRestaurantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRestaurantRepository::class)
 */
class CommandeRestaurant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="commandeRestaurants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_membre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_arrivee;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_depart;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_personne;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $option_room_service;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $option_allergie;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_enregistrement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMembre(): ?Membre
    {
        return $this->id_membre;
    }

    public function setIdMembre(?Membre $id_membre): self
    {
        $this->id_membre = $id_membre;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->date_arrivee;
    }

    public function setDateArrivee(\DateTimeInterface $date_arrivee): self
    {
        $this->date_arrivee = $date_arrivee;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getNbPersonne(): ?int
    {
        return $this->nb_personne;
    }

    public function setNbPersonne(int $nb_personne): self
    {
        $this->nb_personne = $nb_personne;

        return $this;
    }

    public function isOptionRoomService(): ?bool
    {
        return $this->option_room_service;
    }

    public function setOptionRoomService(?bool $option_room_service): self
    {
        $this->option_room_service = $option_room_service;

        return $this;
    }

    public function isOptionAllergie(): ?bool
    {
        return $this->option_allergie;
    }

    public function setOptionAllergie(?bool $option_allergie): self
    {
        $this->option_allergie = $option_allergie;

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

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $date_enregistrement): self
    {
        $this->date_enregistrement = $date_enregistrement;

        return $this;
    }
}
