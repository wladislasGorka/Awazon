<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);

        // Vérifier que les données nécessaires sont présentes
        if (!isset($data['name'], $data['desc'], $data['price'])) {
            return new JsonResponse(['error' => 'Invalid data'], 400);
        }

        // Créer un nouvel utilisateur et définir ses propriétés
        $product = new Product();
        $product->setName($data['name']);
        $product->setDescription($data['desc']);
        $product->setPrice($data['price']);

        // Enregistrer l'utilisateur dans la base de données
        $entityManager->persist($product);
        $entityManager->flush();

        // Envoyer une réponse JSON
        return new JsonResponse(['message' => 'Product created successfully !', 'productId' => $product->getId()], 201);
    }
}
