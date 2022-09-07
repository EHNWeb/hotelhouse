<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ActualiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actualite::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('titre', 'Titre'),
            ChoiceField::new('categorie', 'Catégorie')->setChoices([
                'Divers' => 0,
                'Art' => 1,
                'Ptotographie' => 2,
                'Design' => 3,
                'Danse' => 4,
                'Livres' => 5,
            ]),
            ImageField::new('photo', 'Image')
            ->setBasePath('images/actualite/')
            ->setUploadDir('public/images/actualite')
            ->setUploadedFileNamePattern('[ulid].[extension]')
            ->setRequired(false),
            TextField::new('description', 'Description (courte)'),
            UrlField::new('lien', 'Lien vers l\'actualité'),
            DateTimeField::new('DateEnregistrement', 'Date ajout')->setFormat("dd/MM/Y HH:mm:ss")->onlyOnIndex()
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        // La fonction sera exécuter lors de la creation d'un article avant ADD Article
        $actualite = new Actualite();
        $actualite->setDateEnregistrement(new \DateTime);
        $actualite->setDateModification(new \DateTime);
        $ifile = $actualite->getImageFile();
        if(!$ifile)
        {
            $actualite->setPhoto('default.png');
        }
        return $actualite;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // La fonction sera exécuter lors de la creation d'un article avant ADD Article
        $ifile = $entityInstance->getPhoto();

        if(!$ifile)
        {
            $entityInstance->setPhoto('default.png');
        }
        $entityInstance->setDateModification(new \DateTime);
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }  
}
