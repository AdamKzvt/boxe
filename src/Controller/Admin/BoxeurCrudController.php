<?php

namespace App\Controller\Admin;

use App\Entity\Boxeur;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BoxeurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Boxeur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            ImageField::new('image_name')
            ->setUploadDir('/public/images/article'),
            TextField::new('nomPrenom'),
            TextEditorField::new('information'),
        ];
    }
    
}
