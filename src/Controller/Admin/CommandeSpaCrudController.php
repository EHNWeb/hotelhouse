<?php

namespace App\Controller\Admin;

use App\Entity\CommandeSpa;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandeSpaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CommandeSpa::class;
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
