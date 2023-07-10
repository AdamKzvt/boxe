<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
        
        public function configureCrud(Crud $crud): Crud 
        {
            return $crud
                    ->setEntityLabelInplural('Utilisateurs')
                    ->setEntityLabelInSingular('Utilisateur')
                    ->setPaginatorPageSize(10)   
                    ->setPageTitle("index","Boxing Club Heninois - Administration des Utilisateurs");
        }
    

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('email')
            ->SetFormTypeOption('disabled','disabled'),
            TextField::new('nom'),
            TextField::new('prenom'),
            DateTimeField::new('createdAt')
            ->hideOnForm(),
        ];
    }
    
}
