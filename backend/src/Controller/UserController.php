<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\Merchant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UserController extends AbstractController
{
    #[Route('/register/member', name: 'app_register_member')]
    public function registerMember(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);

        // Vérifier que les données nécessaires sont présentes
        if (!isset($data['name'], $data['email'], $data['password'])) {
            return new JsonResponse(['error' => 'Invalid data'], 400);
        }

        // Créer un nouvel utilisateur et définir ses propriétés
        $user = new Member();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setRoles(['ROLE_MEMBER']);

        // Enregistrer l'utilisateur dans la base de données
        $entityManager->persist($user);
        $entityManager->flush();

        // Envoyer une réponse JSON
        return new JsonResponse(['message' => 'User created successfully', 'userId' => $user->getId()], 201);
    }

    #[Route('/register/merchant', name: 'app_register_merchant')]
    public function registerMerchant(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);

        // Vérifier que les données nécessaires sont présentes
        if (!isset($data['name'], $data['email'], $data['siret'], $data['password'])) {
            return new JsonResponse(['error' => 'Invalid data'], 400);
        }

        // Créer un nouvel utilisateur et définir ses propriétés
        $user = new Merchant();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setSiret($data['siret']);
        $user->setPassword($data['password']);
        $user->setRoles(['ROLE_MERCHANT']);

        // Enregistrer l'utilisateur dans la base de données
        $entityManager->persist($user);
        $entityManager->flush();

        // Envoyer une réponse JSON
        return new JsonResponse(['message' => 'User created successfully', 'userId' => $user->getId()], 201);
    }

    #[Route('/api/test', name: 'api_test')]
    public function test(): JsonResponse
    {
        return new JsonResponse(['message' => 'Communication réussie !']);
    }
}
