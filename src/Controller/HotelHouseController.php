<?php

namespace App\Controller;

use App\Repository\ChambreRepository;
use App\Repository\SliderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelHouseController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Route("/hotel", name="app_hotel_house")
     */
    public function index(SliderRepository $repoSlider, EntityManagerInterface $manager): Response
    {
        $sliders = $repoSlider->findBy(array(), array('ordre' => 'ASC'));
        return $this->render('hotel_house/index.html.twig', [
            'sliders' => $sliders
        ]);
    }

    /**
     * @Route("/hotel/chambre", name="show_chambre")
     */
    public function show_chambre(ChambreRepository $repoChambre, EntityManagerInterface $manager)
    {
        $chambres = $repoChambre->findAll();
        return $this->render('hotel_house/show_chambre.html.twig', [
            'tabChambres' => $chambres
        ]);
    }

    /**
     * @Route("/hotel/chambre/{id}", name="detail_chambre")
     */
    public function detail_chambre($id, ChambreRepository $repoChambre)
    {
        $chambre = $repoChambre->find($id);
        return $this->render('hotel_house/detail_chambre.html.twig', [
            'chambre' => $chambre
        ]);
    }
}