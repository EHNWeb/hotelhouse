<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Message;
use App\Form\MembreType;
use App\Form\ContactType;
use App\Entity\Newsletter;
use App\Form\CommentaireType;
use App\Form\NewsletterType;
use App\Repository\SpaRepository;
use App\Repository\MembreRepository;
use App\Repository\SliderRepository;
use App\Repository\ChambreRepository;
use App\Repository\ActualiteRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommentaireRepository;
use App\Repository\SliderSpaRepository;
use App\Repository\NewsletterRepository;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\SliderRestaurantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

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

    /**
     * @Route("/hotel/spa", name="show_spa")
     */
    public function show_spa(SliderSpaRepository $repoSliderSpa, SpaRepository $repoSpa, EntityManagerInterface $manager): Response
    {
        $sliders = $repoSliderSpa->findBy(array(), array('ordre' => 'ASC'));
        $spa = $repoSpa->findAll();
        return $this->render('hotel_house/show_spa.html.twig', [
            'sliders' => $sliders,
            'tabSpas' => $spa
        ]);
    }

    /**
     *@Route("/hotel/contact", name="hotel_contact") 
     */
    public function hotel_contact(Request $superGlobals, EntityManagerInterface $manager)
    {
        $message = new Message();
        $message->setDateEnregistrement(new \DateTime());

        $messageForm = "Votre message a bien été pris en compte.";

        $form = $this->createForm(ContactType::class, $message);
        $form->handleRequest($superGlobals);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($message);
            $manager->flush();
            $this->addFlash('success', $messageForm);
            return $this->redirectToRoute('hotel_contact');
        }

        return $this->render('hotel_house/hotel_contact.html.twig', [
            'formMessage' => $form->createView()
        ]);
    }

    /**
     * @Route("/hotel/actualite", name="show_actualite")
     */
    public function show_actualite(ActualiteRepository $repoActualite, EntityManagerInterface $manager)
    {
        $actualite = $repoActualite->findAll();
        return $this->render('hotel_house/show_actualite.html.twig', [
            'tabActualites' => $actualite
        ]);
    }

    /**
     * @Route("/hotel/newsletter", name="form_newsletter")
     */
    public function form_newsletter(Request $superGlobals, NewsletterRepository $repoNewsletter, EntityManagerInterface $manager, MailerInterface $mailer)
    {
        $newsletter = new Newsletter();
        $newsletter->setDateEnregistrement(new \DateTime());

        $messageForm = "Votre inscription a bien été prise en compte.";

        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($superGlobals);

        if ($form->isSubmitted() && $form->isValid()) {
            $verifInscription = $repoNewsletter->findOneBy(['email' => $newsletter->getEmail()]);
            if (!$verifInscription) {
                $messageForm = "Votre inscription a bien été prise en compte.";
                $newsletter->setSouscription(true);
                $manager->persist($newsletter);
                $manager->flush();
                $this->addFlash('success', $messageForm);
            } else {
                $messageForm = "Vous êtes déjà inscrit.";
                $this->addFlash('failed', $messageForm);
            }

            // Email
            $email = (new Email())
                ->from('hottin.eric@sfr.fr')
                ->to('eric.hottin@gmail.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Time for Symfony Mailer! test 5')
                ->text('Sending emails is fun again!')
                ->html('<p>See Twig integration for better HTML integration!</p>');
            $mailer->send($email);
            $messageForm = "Email envoyé.";
            $this->addFlash('success', $messageForm);
            //

            return $this->redirectToRoute('home');
        }

        return $this->render('hotel_house/form_newsletter.html.twig', [
            'formNewsletter' => $form->createView()
        ]);
    }

    /**
     * @Route("/profil", name="profil_show")
     */
    public function show_membre(): Response
    {
        return $this->render('hotel_house/show_membre.html.twig');
    }

    /**
     * @Route("/profil_edit/{id}", name="profil_edit")
     */
    public function edit_membre($id, Request $superGlobals, EntityManagerInterface $manager, MembreRepository $repo): Response
    {
        $membre = $repo->find($id);
        $form = $this->createForm(MembreType::class, $membre);

        $form->handleRequest($superGlobals);

        if ($form->isSubmitted() && $form->isValid()) {
            $messageForm = "L'utilisateur n° " . $membre->getId() . " a été modifié !";
            $manager->persist($membre);
            $manager->flush();
            $this->addFlash('success', $messageForm);
            return $this->redirectToRoute('app_logout');
        }

        return $this->render('hotel_house/membre_form.html.twig', [
            'formMembre' => $form->createView()
        ]);
    }

    /**
     * @Route("/hotel/reservation", name="show_reservation")
     */
    public function show_reservation(ChambreRepository $repoChambre, RestaurantRepository $repoRestaurant, SpaRepository $repoSpa, EntityManagerInterface $manager)
    {
        $chambres = $repoChambre->findAll();
        $restaurants = $repoRestaurant->findAll();
        $spas = $repoSpa->findAll();
        return $this->render('hotel_house/show_reservation.html.twig', [
            'tabChambres' => $chambres,
            'tabRestaurants' => $restaurants,
            'tabSpas' => $spas
        ]);
    }

    /**
     * @Route("/hotel/avis", name="form_avis")
     */
    public function form_avis(Request $superGlobals, CommentaireRepository $repoCommentaire, CategorieRepository $repoCategorie, MembreRepository $repoMembre, EntityManagerInterface $manager)
    {
        $commentaires = $repoCommentaire->findAll();
        $categories = $repoCategorie->findAll();

        $commentaire = new Commentaire();
        $commentaire->setDateEnregistrement(new \DateTime());
        if ($this->getUser()) {
            $commentaire->setIdMembre($repoMembre->find($this->getUser()));
        } else {
            return $this->render('hotel_house/form_avis.html.twig', [
                'tabCommentaires' => $commentaires,
                'tabCategories' => $categories
            ]);
        }

        $messageForm = "Votre avis a bien été pris en compte.";

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($superGlobals);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($commentaire);
            $manager->flush();
            $this->addFlash('success', $messageForm);
            return $this->redirectToRoute('home');
        }

        return $this->render('hotel_house/form_avis.html.twig', [
            'formAvis' => $form->createView(),
            'tabCommentaires' => $commentaires,
            'tabCategories' => $categories
        ]);
    }
}
