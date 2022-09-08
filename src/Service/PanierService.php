<?php
namespace App\Service;

use App\Repository\SliderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class PanierService {
    private $rs;
    private $manager;

    public function __construct(RequestStack $rs, EntityManagerInterface $manager) {
        // Hors d'un controller, nous devons faire les injections de dépendances dans un constructeur
        $this->rs = $rs;
        $this->manager = $manager;
    }


}