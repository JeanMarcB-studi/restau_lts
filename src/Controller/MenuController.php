<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menus', name: 'app_menu')]

    public function titi(MenuRepository $MenuRepository): Response
    {

        return $this->render('page/menus.html.twig', [
            'controller_name' => 'MenuController',
            'page' => $this->getCurrentPage(),
            'lines' => $MenuRepository->findAll(),
        ]);
    }

    private function getCurrentPage(): string
    {
        return $_SERVER["PHP_SELF"];
    }







}
