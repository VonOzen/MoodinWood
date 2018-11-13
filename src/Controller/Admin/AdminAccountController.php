<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminAccountController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_login")
     * 
     * @param AuthenticationUtils $utils
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        return $this->render('admin/account/login.html.twig', [
            'hasError' => $error !== null, 
            'username' => $utils->getLastUsername()
        ]);
    }

    /**
     * Allow admin logout
     *
     * @Route("admin/logout", name="admin_logout")
     * 
     * @return void
     */
    public function logout()
    {
        // ...
    }
}
