<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelHouseController extends AbstractController
{
    /**
     * @Route("/hotel/house", name="app_hotel_house")
     */
    public function index(): Response
    {
        return $this->render('hotel_house/index.html.twig', [
            'controller_name' => 'HotelHouseController',
        ]);
    }
}
