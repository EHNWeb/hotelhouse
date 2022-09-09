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
        $spaWithData = $cs->getSpaWithData();
        $totalPanier = $cs->getTotalPanier();

        return $this->render('hotel_house/show_panier.html.twig', [
            'panierChambres' => $chambreWithData,
            'panierSpas' => $spaWithData,
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
     * @Route("/spa/add/{id}", name="spa_add")
     */
    public function addSpa($id, PanierService $cs): Response
    {

        $cs->addSpa($id);

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
     * @Route("/spa/remove/{id}", name="spa_remove")
     */
    public function removeSpa($id, PanierService $cs)
    {
        $cs->removeSpa($id);
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
     * @Route("/spa/decrease/{id}", name="spa_decrease")
     */
    public function decreaseSpa($id, PanierService $cs): Response
    {

        $cs->decrementSpa($id);

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
     * @Route("/spa/delete", name="spa_delete")
     */
    public function deleteSpa(PanierService $cs): Response
    {
       $cs->emptySpa();

       return $this->redirectToRoute('app_panier');
    }

    /**
     * @Route("/order", name="app_order")
     */
    public function order(PanierService $cs): Response
    {

        $chambreWithData = $cs->getChambreWithData();
        $spaWithData = $cs->getSpaWithData();
        $totalPanier = $cs->getTotalPanier();

        return $this->render('myshop/show_order.html.twig', [
            'chambres' => $chambreWithData,
            'spas' => $spaWithData,
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

    /**
     * @Route("/panier/delete", name="panier_delete")
     */
    public function deletepanier(PanierService $cs): Response
    {
       $cs->emptyChambre();
       $cs->emptySpa();

       return $this->redirectToRoute('app_panier');
    }
}
