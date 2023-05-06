<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NavController extends AbstractController
{
    // public function navBar(): Response
    // {
    //     return $this->render('page/nav.html.twig', 
    //     [
    //         'menu_items' => $this->getMenuItems(),
    //         'page' => $this->getCurrentPage(),
    //     ]);
    // }

    // private function getCurrentPage(): string
    // {
    //     return $_SERVER["PHP_SELF"]."kk";
    // }

    public function getMenuItems() : Response
    {
        // my menu elements
        $mainMenu = [
            '/' => 'Accueil',
            '/carte' => 'notre Carte',
            '/menus' => 'nos Menus',
            '/booking' => 'RESERVER'
        ];
        
        //determine on which Page we currently are 
        $currentPage = $_SERVER["PHP_SELF"];
        $currentPage = substr($currentPage, - strlen($currentPage) + strrpos($currentPage, "/"));
        
        //calculate class to be used
        $menuItems = [];
        foreach ($mainMenu as $file => $title) {
            // Does the menu item correspond to the current page shown?
            $is_active = ($file === $currentPage);
            // Adapt the style based on the menu item
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
            //put all necessary data into a table         
            $menuItems[] = [
                'class' => $classMenu,
                'id' => $title,
                'href' => $file,
                'title' => $title,
            ];
        }
        // return($menuItems);
        return $this->render('page/nav.html.twig', [
            'menu_items' => $menuItems,
        ]);

    }

}
