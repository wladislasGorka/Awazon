<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/api/user/me', name: 'app_me')]
    #[IsGranted('ROLE_USER')]
    public function me(Request $request, SerializerInterface $serializer): JsonResponse
    {
        // sérialisation de l'bjet User en JSON, en retirant les attributs sensibles.
        $userData = $serializer->serialize($this->getUser(), 'json', [
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['password','imgProfil', 'paypalAccount', 'paypalId']
        ]);
        
        return new JsonResponse(['message:' => 'UserController', 'User:' => $userData]);
    }
}