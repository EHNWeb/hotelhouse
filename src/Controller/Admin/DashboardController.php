<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use App\Entity\Chambre;
use App\Entity\CommandeChambre;
use App\Entity\CommandeRestaurant;
use App\Entity\CommandeSpa;
use App\Entity\Commentaire;
use App\Entity\Membre;
use App\Entity\Message;
use App\Entity\Newsletter;
use App\Entity\Option;
use App\Entity\Restaurant;
use App\Entity\Slider;
use App\Entity\SliderRestaurant;
use App\Entity\SliderSpa;
use App\Entity\Spa;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hotelhouse');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToRoute('Accueil', 'fa fa-home', 'home'),
            MenuItem::linkToDashboard('Admin', 'fa fa-gear'),
            MenuItem::section('Hôtel', 'fa fa-house-user'),
            MenuItem::linkToCrud('Chambres', 'fa fa-bed', Chambre::class),
            MenuItem::linkToCrud('Restauration', 'fa fa-utensils', Restaurant::class),
            MenuItem::linkToCrud('Spa', 'fa fa-spa', Spa::class),
            MenuItem::section('Services', 'fa fa-coins'),
            MenuItem::linkToCrud('Cde Chambre', 'fa fa-bed', CommandeChambre::class),
            MenuItem::linkToCrud('Cde Restaurant', 'fa fa-utensils', CommandeRestaurant::class),
            MenuItem::linkToCrud('Cde Spa', 'fa fa-spa', CommandeSpa::class),
            MenuItem::section('Utilisateurs', 'fa fa-users'),
            MenuItem::linkToCrud('Membres', 'fa fa-user', Membre::class),
            MenuItem::linkToCrud('Commentaires', 'fa fa-comments', Commentaire::class),
            MenuItem::linkToCrud('Newsletters', 'fa fa-envelope-open-text', Newsletter::class),
            MenuItem::linkToCrud('Messages', 'fa fa-envelope', Message::class),
            MenuItem::section('Site', 'fa fa-globe'),
            MenuItem::linkToCrud('Slider Accueil', 'fa fa-images', Slider::class),
            MenuItem::linkToCrud('Slider restaurant', 'fa fa-images', SliderRestaurant::class),
            MenuItem::linkToCrud('Slider spa', 'fa fa-images', SliderSpa::class),
            MenuItem::linkToCrud('Actualités', 'fa fa-newspaper', Actualite::class),
            MenuItem::linkToCrud('Options', 'fa fa-check', Option::class)
        ];

    }
}
