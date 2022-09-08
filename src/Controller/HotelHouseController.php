<?php

namespace App\Controller;

use App\Repository\ChambreRepository;
use App\Repository\RestaurantRepository;
use App\Repository\SliderRepository;
use App\Repository\SliderRestaurantRepository;
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

     /**
     * @Route("/hotel/restaurant", name="show_restaurant")
     */
    public function show_restaurant(SliderRestaurantRepository $repoSliderRestaurant, RestaurantRepository $repoRestaurant, EntityManagerInterface $manager): Response
    {
        $sliders = $repoSliderRestaurant->findBy(array(), array('ordre' => 'ASC'));
        $restaurant = $repoRestaurant->findAll();
        return $this->render('hotel_house/show_restaurant.html.twig', [
            'sliders' => $sliders,
            'tabRestaurants' => $restaurant
        ]);
    }

}