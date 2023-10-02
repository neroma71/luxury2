<?php

namespace App\Controller\Admin;

use App\Entity\OffreEmploi;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OffreEmploiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OffreEmploi::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('ref'),
            TextField::new('description'),
            BooleanField::new('is_active'),
            TextField::new('notes'),
            AssociationField::new('client')
            ->autocomplete(),
            TextField::new('job_title'),
            TextField::new('job_type'),
            TextField::new('location'),
            TextField::new('job_category'),
            DateField::new('closing_date'),
            IntegerField::new('salary'),
            DateField::new('date_creation'),
        ];
    }
    
}
