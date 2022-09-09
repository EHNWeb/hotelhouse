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
     * @Route("/cart", name="app_cart")
     */
    public function index(PanierService $cs): Response
    {

        $cartWithData = $cs->getCartWithData();
        $totalPanier = $cs->getTotalPanier();

        return $this->render('myshop/show_panier.html.twig', [
            'items' => $cartWithData,
            'totalPanier' => $totalPanier,
        ]);
    }

    /**
     * @Route("/chambre/add/{id}", name="chambre_add")
     */
    public function addChambre($id, PanierService $cs): Response
    {

        $cs->add($id);

        return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route("/chambre/remove/{id}", name="chambre_remove")
     */
    public function removeChambre($id, PanierService $cs)
    {
        $cs->remove($id);
        return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route("/chambre/decrease/{id}", name="chambre_decrease")
     */
    public function decreaseChambre($id, PanierService $cs): Response
    {

        $cs->decrement($id);

        return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route("/cart/delete", name="cart_delete")
     */
    public function deleteChambre(PanierService $cs): Response
    {
       $cs->empty();

       return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route("/order", name="app_order")
     */
    public function order(PanierService $cs): Response
    {

        $cartWithData = $cs->getCartWithData();
        $totalPanier = $cs->getTotalPanier();

        return $this->render('myshop/show_order.html.twig', [
            'items' => $cartWithData,
            'totalPanier' => $totalPanier,
        ]);
    }

     /**
     * @Route("/cart/buy/{id}", name="cart_buy")
     */
    public function buy($id, PanierService $cs): Response
    {
       $cs->passOrder($id);

       $cs->empty();

       return $this->redirectToRoute('app_order');
    }
}
