<?php

namespace App\Controller;

use App\Service\PanierService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="app_panier")
     */
    public function index(PanierService $cs): Response
    {

        $chambreWithData = $cs->getChambreWithData();
        $totalPanier = $cs->getTotalPanier();

        return $this->render('hotel_house/show_panier.html.twig', [
            'panierChambres' => $chambreWithData,
            'totalPanier' => $totalPanier,
        ]);
    }

    /**
     * @Route("/chambre/add/{id}", name="chambre_add")
     */
    public function addChambre($id, PanierService $cs): Response
    {

        $cs->addChambre($id);

        return $this->redirectToRoute('app_panier');
    }

    /**
     * @Route("/chambre/remove/{id}", name="chambre_remove")
     */
    public function removeChambre($id, PanierService $cs)
    {
        $cs->removeChambre($id);
        return $this->redirectToRoute('app_panier');
    }

    /**
     * @Route("/chambre/decrease/{id}", name="chambre_decrease")
     */
    public function decreaseChambre($id, PanierService $cs): Response
    {

        $cs->decrementChambre($id);

        return $this->redirectToRoute('app_panier');
    }

    /**
     * @Route("/chambre/delete", name="chambre_delete")
     */
    public function deleteChambre(PanierService $cs): Response
    {
       $cs->emptyChambre();

       return $this->redirectToRoute('app_panier');
    }

    /**
     * @Route("/order", name="app_order")
     */
    public function order(PanierService $cs): Response
    {

        $chambreWithData = $cs->getChambreWithData();
        $totalPanier = $cs->getTotalPanier();

        return $this->render('myshop/show_order.html.twig', [
            'items' => $chambreWithData,
            'totalPanier' => $totalPanier,
        ]);
    }

     /**
     * @Route("/cart/buy/{id}", name="cart_buy")
     */
    public function buy($id, PanierService $cs): Response
    {
       $cs->passOrder($id);

       $cs->emptyChambre();

       return $this->redirectToRoute('app_order');
    }
}
