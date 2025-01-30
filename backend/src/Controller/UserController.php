<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);

        // Vérifier que les données nécessaires sont présentes
        if (!isset($data['name'], $data['email'], $data['password'])) {
            return new JsonResponse(['error' => 'Invalid data'], 400);
        }

        // Créer un nouvel utilisateur et définir ses propriétés
        $user = new User();
        $user->setName($data['name']);
        $user->setMail($data['email']);
        $user->setPassword($data['password']);

        // Enregistrer l'utilisateur dans la base de données
        $entityManager->persist($user);
        $entityManager->flush();

        // Envoyer une réponse JSON
        return new JsonResponse(['message' => 'User created successfully', 'userId' => $user->getId()], 201);
    }
}
