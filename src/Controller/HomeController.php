<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class HomeController extends AbstractController{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $superAdmin = ["ROLE_SUPER_ADMIN", "ROLE_ADMIN", "ROLE_EDITOR", "ROLE_USER"];
        $admin = ["ROLE_ADMIN", "ROLE_EDITOR", "ROLE_USER"];
        $editor = ["ROLE_EDITOR", "ROLE_USER"];
        $user = [];

        // if ($this->getUser()) {
        //     dd($this->getUser('Utilisateur connecté'));
        // }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Page d\'acceuil',
        ]);
    }

    #[Route('/super-admin/dashbord', name: 'app_super_admin_dashboard')]
    public function dashboard():Response
    {
        return new response('Vous êtes connecté en tant que admin');
    }

    #[Route('/user/dashboard', name: 'app_user_admin_dashboard')]
    public function userDashboard():Response
    {
        return new response('Vous êtes connecté en tant que utilisateur');
    }
}
