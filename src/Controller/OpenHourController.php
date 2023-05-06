<?php

namespace App\Controller;

use App\Repository\OpenHourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpenHourController extends AbstractController
{
    #[Route('/test', name: 'app_test')]

    public function openDays(OpenHourRepository $OpenHourRepository): Response
    {
        $week = $OpenHourRepository->findAll();
        
        $day_lines = array();
        $day0 = '';
        $day_previous ='';
        $l_start0 = '';
        $l_end0 = '';
        $l_max0 = '';
        $d_start0 = '';
        $d_end0 = '';
        $d_max0 = '';

        foreach ($week as $num => $day_hours) 
        {
            $day = $day_hours->getWeekDay();

            $l_start = $day_hours->getLunchStart()->format('H:i');
            $l_end = $day_hours->getLunchEnd()->format('H:i');
            $l_max = $day_hours->getLunchMax();
            $l_start = $l_max === 0 ? "" : $l_start;
            
            $d_start = $day_hours->getDinnerStart()->format('H:i');
            $d_end = $day_hours->getDinnerEnd()->format('H:i');
            $d_max = $day_hours->getDinnerMax();
            $d_start = $d_max === 0 ? "" : $d_start;
            
            if (empty($day0)) 
            {
                // first day of week, take picture of data
                $day0 = $day;
                $day_previous = $day;
                $l_start0 = $l_start;
                $l_end0 = $l_end;
                $l_max0 = $l_max;
                $d_start0 = $d_start;
                $d_end0 = $d_end;
                $d_max0 = $d_max;            
            } 
            else 
            {
                // check if new day has same hours as $day0
                if (($l_start0 != $l_start) or ($l_end0 != $l_end) or ($d_start0 != $d_start) or ($d_end0 != $d_end)){
                    
                    // hours have changed, need to publish
                    $day_range = ($day0 != $day_previous) ? "Du $day0 au $day_previous : " : "Le $day0 : "; 
                    
                    $line = '';
                    // open for lunch?
                    if ($l_max0 > 0) {
                        $line .= "de $l_start0 à $l_end0";
                    }
                    // open for dinner?
                    if ($d_max0 > 0) {
                        $line .= empty($line) ? '' : ' et ';
                        $line .= "de $d_start0 à $d_end0";
                    }
                    // day closed?
                    $line = empty($line) ? 'fermé' : 'ouvert ' . $line;
                    
                    // ----- Add for Publish
                    $day_lines[] = $day_range . $line;
                    
                    // store current
                    $day0 = $day;
                    $l_start0 = $l_start;
                    $l_end0 = $l_end;
                    $l_max0 = $l_max;
                    $d_start0 = $d_start;
                    $d_end0 = $d_end;
                    $d_max0 = $d_max;
                }

                $day_previous = $day;
            }
        }
        
        // last day, need to publish
        $day_range = ($day0 != $day_previous) ? "Du $day0 au $day_previous : " : "Le $day0 : "; 
        if ($day0 === 'Samedi' and $day_previous === 'Dimanche') {
            $day_range = 'Le Week-End : ';
        }

        $line = '';
        // open for lunch?
        if ($l_max0 > 0) {
            $line .= "de $l_start0 à $l_end0";
        }
        // open for dinner?
        if ($d_max0 > 0) {
            $line .= empty($line) ? '' : ' et ';
            $line .= "de $d_start0 à $d_end0";
        }
        // day closed?
        $line = empty($line) ? 'fermé' : 'ouvert ' . $line;
        
        // ----- Add for Publish
        $day_lines[] = $day_range . $line;

        return $this->render('page/openHour.html.twig', 
        [
            'openDays' => $day_lines,
        ]
    );
    }

}
