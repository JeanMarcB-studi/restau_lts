<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use App\Entity\Category;
use App\Entity\Meal;
use App\Entity\Menu;
use App\Entity\OpenHour;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();
        return $this->render('admin/dashboard.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Le Quai Antique');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Administration', 'fa-solid fa-house-chimney');
        yield MenuItem::linkToCrud('Horaires d\'ouverture', 'fas fa-list', OpenHour::class);
        yield MenuItem::linkToCrud('Menus', 'fas fa-list', Menu::class);
        yield MenuItem::linkToCrud('Les plats de la carte', 'fas fa-list', Meal::class);
        yield MenuItem::linkToCrud('Catégories de plats', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('les Réservations', 'fas fa-list', Booking::class);
    }
}
