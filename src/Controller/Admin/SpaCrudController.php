<?php

namespace App\Controller\Admin;

use App\Entity\Spa;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SpaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Spa::class;
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
