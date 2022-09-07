<?php

namespace App\Controller\Admin;

use App\Entity\Spa;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class SpaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Spa::class;
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
            ImageField::new('FicheSoin', 'Fiche de soin')
            ->setBasePath('images/spa/')
            ->setUploadDir('public/images/spa')
            ->setUploadedFileNamePattern('[ulid].[extension]')
            ->setRequired(false)
            ->hideOnIndex()
            ->setFormTypeOptions(['attr' => [
                    'accept' => 'application/pdf'
                    ]
            ]),
            TextField::new('FicheSoin', 'Fiche de soin')->setTemplatePath('admin/field/spa_link.html.twig')->onlyOnIndex(),
            IntegerField::new('quantite', 'Nb crénaux disponibles'),
            NumberField::new('montant', 'Prix')->setNumDecimals(2),
            DateTimeField::new('DateEnregistrement', 'Date ajout')->setFormat("dd/MM/Y HH:mm:ss")->onlyOnIndex()
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $spa = new Spa();
        $spa->setDateEnregistrement(new \DateTime);
        $spa->setDateModification(new \DateTime);
        $ifile = $spa->getImageFile();
        if(!$ifile)
        {
            $spa->setFicheSoin('default.png');
        }
        return $spa;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $ifile = $entityInstance->getFicheSoin();

        if(!$ifile)
        {
            $entityInstance->setFicheSoin('default.png');
        }
        $entityInstance->setDateModification(new \DateTime);
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }  
    
}
