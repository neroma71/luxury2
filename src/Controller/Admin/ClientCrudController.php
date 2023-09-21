<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('activity_type'),
            TextField::new('contact_name'),
            TextField::new('contact_post'),
            TextField::new('contact_phone'),
            TextField::new('contact_email'),
            TextField::new('notes')
        ];
    }

}
