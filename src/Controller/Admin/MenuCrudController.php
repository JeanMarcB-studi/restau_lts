<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use Doctrine\ORM\Mapping\Id;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class MenuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Menu::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            
            Field::new('Title'),
            'Type',
            'valid_when',
            'detail',
            'price'
        ];
    }
    */
    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         IdField::new('id'),
    //         TextField::new('title'),
    //         TextEditorField::new('description'),
    //     ];
    // }
    


}
