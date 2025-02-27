<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;



final class LoginController extends AbstractController{
    #[Route('/api/login', name: 'api_login')]
    public function index(Request $request, UserRepository $userRepository): JsonResponse
    {
        // Récupérer les données JSON envoyées par le client
        $data = json_decode($request->getContent(), true);
        $email = $data['email'] ?? null;

        if (!$email) {
            return $this->json(['error' => 'Email is required'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Rechercher l'utilisateur par email
        $user = $userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            return $this->json(['error' => 'User not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        // Retourner les informations utilisateur
        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'first_name'=>$user->getFirstName(),
            'last_name'=>$user->getLastName()
        ]);
    }

    #[Route('/login/link', name: 'login_check')]
    public function loginCheck():never
    {
        throw new \LogicException("");
    }

    #[Route('/login/link/generate', name:'login_generate')]
    public function _generateUrl(LoginLinkHandlerInterface $loginLinkHandler):Response
    {
        $user = $this->getUser();

        $loginLinkDetails = $loginLinkHandler->createLoginLink($user);
        $loginLink = $loginLinkDetails->getUrl();


        dd($loginLink);
    }
}
