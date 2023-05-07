<?php

namespace App\Controller\Admin;

use App\Entity\OpenHour;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OpenHourCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpenHour::class;
    }

    // public function configureFields(string $pageName): iterable
    // {
    //     yield TextField::new('week_day');
    // }


        // $day = $day_hours->getWeekDay();

        // $l_start = $day_hours->getLunchStart()->format('H:i');
        // $l_end = $day_hours->getLunchEnd()->format('H:i');
        // $l_max = $day_hours->getLunchMax();
        // $l_start = $l_max === 0 ? "" : $l_start;
        
        // $d_start = $day_hours->getDinnerStart()->format('H:i');
        // $d_end = $day_hours->getDinnerEnd()->format('H:i');
        // $d_max = $day_hours->getDinnerMax();
        // $d_start = $d_max === 0 ? "" : $d_start;





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

