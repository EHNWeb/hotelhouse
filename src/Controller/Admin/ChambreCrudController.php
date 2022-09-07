<?php

namespace App\Controller\Admin;

use App\Entity\Chambre;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ChambreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chambre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('titre', 'Titre'),
            TextField::new('description_courte', 'Description (courte)'),
            TextareaField::new('description_longue', 'Description (longue)')
                ->renderAsHtml()
                ->hideOnForm(),
            TextEditorField::new('description_longue', 'Description (longue)')->onlyOnForms(),
            ImageField::new('photo', 'Image')
            ->setBasePath('images/chambre/')
            ->setUploadDir('public/images/chambre')
            ->setUploadedFileNamePattern('[ulid].[extension]')
            ->setRequired(false),
            NumberField::new('prix', 'prix journalier')->setNumDecimals(2),
            IntegerField::new('quantite', 'Nb chambre total'),
            DateTimeField::new('DateEnregistrement', 'Date ajout')->setFormat("dd/MM/Y HH:mm:ss")->onlyOnIndex()

        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $chambre = new Chambre();
        $chambre->setDateEnregistrement(new \DateTime);
        $chambre->setDateUpdate(new \DateTime);
        $ifile = $chambre->getImageFile();
        if(!$ifile)
        {
            $chambre->setPhoto('default.png');
        }
        return $chambre;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $ifile = $entityInstance->getPhoto();

        if(!$ifile)
        {
            $entityInstance->setPhoto('default.png');
        }
        $entityInstance->setDateUpdate(new \DateTime);
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }  
}
