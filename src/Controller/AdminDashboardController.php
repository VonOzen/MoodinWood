<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    /**
     * Admin dashboard
     * 
     * @Route("/admin", name="admin_dashboard")
     * 
     * @param ObjectManager $manager
     * @return Response
     */
    public function dashboard(ObjectManager $manager)
    {
        return $this->render('admin/dashboard/dashboard.html.twig');
    }
}
