<?php

namespace App\Controller\Admin;

use App\Entity\CommandeChambre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandeChambreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CommandeChambre::class;
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
