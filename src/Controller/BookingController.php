<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Repository\OpenHourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    #[Route('/booking', name: 'app_booking')]

    public function index(OpenHourRepository $OpenHourRepository): Response
    {        
        return $this->render('page/booking.html.twig', 
        [
            // 'controller_name' => 'MealController',
            'lines' => $OpenHourRepository->findAll(),
            
        ]);
    }

}
