<?php

namespace App\Controller\Admin;

use App\Entity\CommandeRestaurant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandeRestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CommandeRestaurant::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
