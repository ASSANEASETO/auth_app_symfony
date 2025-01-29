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

        // if ($this->getUser()) {
        //     dd($this->getUser('Utilisateur connecté'));
        // }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Page d\'acceuil',
        ]);
    }
}
