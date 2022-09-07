<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Option::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('titre', 'Titre'),
            ChoiceField::new('categorie', 'Catégorie')->setChoices([
                'Aucun(e)' => 0,
                'Chambre' => 1,
                'Animal' => 2,
                'Parking' => 3,
                'Arrivée / Départ' => 4,
                'Taxe' => 5,
                'Petit déjeuné' => 6,
            ]),
            NumberField::new('prix', 'Prix')->setNumDecimals(2)
        ];
    }
}
