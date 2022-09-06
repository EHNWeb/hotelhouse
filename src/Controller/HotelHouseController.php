<?php

namespace App\Controller;

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

}