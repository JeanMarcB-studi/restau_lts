<?php

namespace App\Controller;
// namespace App\Repository\CategoryRepository;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    
    public function index(CategoryRepository $CategoryRepository): Response
    
    // public function index(): Response
    {
        $tt = $CategoryRepository->findAll();
        // dd($tt); //****************************************************************** */

        // $articles = $this->getDoctrine()->getRepository(Articles::class)->findAll();
        return $this->render('page/menu.html.twig', [
            'controller_name' => 'CategoryController',
            'menu_items' => $this->getMenuItems(),
            // 'lines' => $this->getAllRecords($CategoryRepository),
            'lines' => $tt,
// 

        ]);
    }

    private function getAllRecords(CategoryRepository $CategoryRepository)
    {
        return $CategoryRepository->findAll();
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
        // my menu elements
        $mainMenu = [
            '/index.php' => 'Accueil',
            '/carte.php' => 'notre Carte',
            '/menu' => 'nos Menus',
            '/booking.php' => 'RESERVER'
        ];
        
        $menuItems = [];
        foreach ($mainMenu as $file => $title) {
            // Does the menu item correspond to the current page shown?
            $is_active = ($file === '/'.basename($_SERVER["SCRIPT_NAME"]));
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
        return($menuItems);
    }



}
