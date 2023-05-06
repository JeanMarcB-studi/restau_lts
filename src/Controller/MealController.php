<?php

namespace App\Controller;

use App\Repository\MealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MealController extends AbstractController
{
    #[Route('/carte', name: 'app_meal')]

    public function index(MealRepository $MealRepository): Response
    {        
        return $this->render('page/meal.html.twig', 
        [
            'controller_name' => 'MealController',
            'lines' => $MealRepository->queryAll(),
        ]);
    }

}
