<?php

namespace App\Entity;

use App\Repository\CommandeChambreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeChambreRepository::class)
 */
class CommandeChambre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="commandeChambres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_chambre;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="commandeChambres")
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_option_lit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_option_animal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_option_parking;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_option_early_checkin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_option_early_checkout;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_option_tds;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_enregistrement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_option_pdj;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdChambre(): ?Chambre
    {
        return $this->id_chambre;
    }

    public function setIdChambre(?Chambre $id_chambre): self
    {
        $this->id_chambre = $id_chambre;

        return $this;
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

    public function getIdOptionLit(): ?int
    {
        return $this->id_option_lit;
    }

    public function setIdOptionLit(?int $id_option_lit): self
    {
        $this->id_option_lit = $id_option_lit;

        return $this;
    }

    public function getIdOptionAnimal(): ?int
    {
        return $this->id_option_animal;
    }

    public function setIdOptionAnimal(?int $id_option_animal): self
    {
        $this->id_option_animal = $id_option_animal;

        return $this;
    }

    public function getIdOptionParking(): ?int
    {
        return $this->id_option_parking;
    }

    public function setIdOptionParking(?int $id_option_parking): self
    {
        $this->id_option_parking = $id_option_parking;

        return $this;
    }

    public function getIdOptionEarlyCheckin(): ?int
    {
        return $this->id_option_early_checkin;
    }

    public function setIdOptionEarlyCheckin(?int $id_option_early_checkin): self
    {
        $this->id_option_early_checkin = $id_option_early_checkin;

        return $this;
    }

    public function getIdOptionEarlyCheckout(): ?int
    {
        return $this->id_option_early_checkout;
    }

    public function setIdOptionEarlyCheckout(?int $id_option_early_checkout): self
    {
        $this->id_option_early_checkout = $id_option_early_checkout;

        return $this;
    }

    public function getIdOptionTds(): ?int
    {
        return $this->id_option_tds;
    }

    public function setIdOptionTds(?int $id_option_tds): self
    {
        $this->id_option_tds = $id_option_tds;

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

    public function getIdOptionPdj(): ?int
    {
        return $this->id_option_pdj;
    }

    public function setIdOptionPdj(?int $id_option_pdj): self
    {
        $this->id_option_pdj = $id_option_pdj;

        return $this;
    }
}
