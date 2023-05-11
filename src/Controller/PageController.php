<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_page')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
        ]);
    }

    private function getCurrentDate(): string
    {
        return date('Y-m-d');
    }

    private function getCurrentPage(): string
    {
        return $_SERVER["SCRIPT_NAME"];
    }

 

}
