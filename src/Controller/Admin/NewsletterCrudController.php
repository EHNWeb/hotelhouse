<?php

namespace App\Controller\Admin;

use App\Entity\Newsletter;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NewsletterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Newsletter::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            EmailField::new('email', 'E-mail'),
            BooleanField::new('souscription', 'Souscription')->renderAsSwitch(false),
            DateTimeField::new('DateEnregistrement', "Date<br>Enregistrement")->setFormat("dd/MM/Y HH:mm:ss")->onlyOnIndex(),
        ];
    }
    
    public function createEntity(string $entityFqcn)
    {
        $newsletter = new Newsletter();
        $newsletter->setDateEnregistrement(new \DateTime);
        return $newsletter;
    }

}
