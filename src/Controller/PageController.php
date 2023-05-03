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
            'controller_name' => 'PageController',
            'toto' => $this->getCurrentPage(),
            'menu_items' => $this->getMenuItems(),
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

    private function getMenuItems()
    {
        $mainMenu = [
            '/index.php' => 'Accueil',
            '/carte.php' => 'notre Carte',
            '/menus.php' => 'nos Menus',
            '/booking.php' => 'RESERVER'
        ];
        
        $menuItems = [];
        foreach ($mainMenu as $file => $title) {
            // Does the menu item correspond to the current page shown?
            $is_active = ($file === '/'.basename($_SERVER["SCRIPT_NAME"]));
        
            if ($title === 'RESERVER') {
                if ($is_active) {
                    $classMenu = 'myActive';
                    $file = "#";
                } else {
                    $classMenu = 'bton d-block myBtonBook';      
                }
            } else {
                if ($is_active) {
                    $classMenu = 'myActive';
                    $file = "#";
                } else {
                    $classMenu = 'myMenu ';
                }    
            }
            
            $menuItems[] = [
                'class' => $classMenu,
                'id' => $title,
                'href' => $file,
                'title' => $title,
            ];
        }
        return($menuItems);
    }

}
