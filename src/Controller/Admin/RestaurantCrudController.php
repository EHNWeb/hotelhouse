<?php

namespace App\Controller\Admin;

use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Restaurant::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('titre', 'Titre'),
            TextField::new('description_courte', 'Description (courte)'),
            TextareaField::new('description', 'Description (longue)')
                ->renderAsHtml()
                ->hideOnForm(),
            TextEditorField::new('description', 'Description (longue)')->onlyOnForms(),
            ImageField::new('carte', 'Menu')
            ->setBasePath('images/restaurant/')
            ->setUploadDir('public/images/restaurant')
            ->setUploadedFileNamePattern('[ulid].[extension]')
            ->setRequired(false)
            ->hideOnIndex()
            ->setFormTypeOptions(['attr' => [
                    'accept' => 'application/pdf'
                    ]
            ]),
            TextField::new('carte', 'Menu')->setTemplatePath('admin/field/restaurant_link.html.twig')->onlyOnIndex(),
            IntegerField::new('quantite', 'Nb table disponibles'),
            DateTimeField::new('DateEnregistrement', 'Date ajout')->setFormat("dd/MM/Y HH:mm:ss")->onlyOnIndex()
        ];
    }
    
    public function createEntity(string $entityFqcn)
    {
        $restaurant = new Restaurant();
        $restaurant->setDateEnregistrement(new \DateTime);
        $restaurant->setDateModification(new \DateTime);
        $ifile = $restaurant->getImageFile();
        if(!$ifile)
        {
            $restaurant->setCarte('default.png');
        }
        return $restaurant;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $ifile = $entityInstance->getCarte();

        if(!$ifile)
        {
            $entityInstance->setCarte('default.png');
        }
        $entityInstance->setDateModification(new \DateTime);
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }  
}
