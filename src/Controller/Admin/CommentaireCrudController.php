<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Id')->onlyOnIndex(),
            TextField::new('titre', 'Titre'),
            ChoiceField::new('categorie', 'Catégorie')->setChoices([
                'Hôtel' => 1,
                'Chambre' => 2,
                'Restaurant' => 3,
                'Spa' => 4
            ]),
            TextareaField::new('commentaire', 'Commentaire')
            ->renderAsHtml()
            ->hideOnForm(),
            AssociationField::new('id_membre', 'Membre')->setTemplatePath('admin/field/commentaires.html.twig'),
            DateTimeField::new('DateEnregistrement', 'Date ajout')->setFormat("dd/MM/Y HH:mm:ss")->onlyOnIndex(),
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $commentaire = new Commentaire();
        $commentaire->setDateEnregistrement(new \DateTime);
        return $commentaire;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::NEW, Action::DELETE, Action::EDIT);
    }
}
