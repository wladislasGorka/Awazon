<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

final class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(Request $request, UsersRepository $usersRepository, JWTTokenManagerInterface $JWTManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $datas = json_decode($request->getContent(), true);
        $user = $usersRepository->findOneBy(['email' => $datas['email']]);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found.'], Response::HTTP_UNAUTHORIZED);
        }

        if (!$passwordHasher->isPasswordValid($user, $datas['password'])) {
            throw new BadCredentialsException();
        }
        
        return new JsonResponse([
            'id' => $user->getId(),
            'email' => $user->getUserIdentifier(),
            'roles' => $user->getRoles(),
            'token' => $JWTManager->create($user)
        ]);
    }

    /**
    * @Route('/logout', name: 'app_logout')
    */    
    public function logout() 
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
