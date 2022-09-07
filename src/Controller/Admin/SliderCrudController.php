<?php

namespace App\Controller\Admin;

use App\Entity\Slider;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SliderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slider::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('titre', 'Titre'),
            TextField::new('texte', 'Sous-titre'),
            ImageField::new('photo', 'Image')
            ->setBasePath('images/slider/')
            ->setUploadDir('public/images/slider')
            ->setUploadedFileNamePattern('[ulid].[extension]')
            ->setRequired(false),
            IntegerField::new('ordre', 'Ordre'),
            DateTimeField::new('DateEnregistrement', 'Date ajout')->setFormat("dd/MM/Y HH:mm:ss")->onlyOnIndex()
        ];
    }
    
    public function createEntity(string $entityFqcn)
    {
        // La fonction sera exécuter lors de la creation d'un article avant ADD Article
        $slider = new Slider();
        $slider->setDateEnregistrement(new \DateTime);
        $slider->setDateModification(new \DateTime);
        $ifile = $slider->getImageFile();
        if(!$ifile)
        {
            $slider->setPhoto('default.png');
        }
        return $slider;
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
