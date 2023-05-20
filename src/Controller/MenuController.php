<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menus', name: 'app_menus')]

    public function index(MenuRepository $MenuRepository): Response
    {

        return $this->render('page/menus.html.twig', 
        [
            'controller_name' => 'MenuController',
            'lines' => $MenuRepository->findAll(),
        ]);
    }

    private function getCurrentPage(): string
    {
        return $_SERVER["PHP_SELF"];
    }

}
