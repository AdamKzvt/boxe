<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Staff;
use App\Entity\Article;
use App\Entity\Boxeur;
use App\Entity\Licence;
use App\Entity\Commentaires;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administartions Boxe')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-users',User::class );
        yield MenuItem::linkToCrud('Articles', 'fa-solid fa-newspaper',Article::class );
        yield MenuItem::linkToCrud('Commentaires', 'fa-regular fa-comments',Commentaires::class );
        yield MenuItem::linkToCrud('Staff', 'fa-solid fa-person',Staff::class );
        yield MenuItem::linkToCrud('Boxeurs', 'fa-solid fa-people-group',Boxeur::class );
        yield MenuItem::linkToCrud('Licence', 'fa-sharp fa-solid fa-file-circle-check',Licence::class );
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
