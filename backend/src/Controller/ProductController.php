<?php // src/Controller/ProductController.php
namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/api/products", name="create_product", methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $product = new Product();
        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setPrice($data['price']);

        $em->persist($product);
        $em->flush();

        return new JsonResponse(['id' => $product->getId()], JsonResponse::HTTP_CREATED);
    }

    // Obtenir les détails d'un produit
    #[Route('/products/{id}', name: 'app_product_detail')]
    public function product(int $id, ProductRepository $productRepository, SerializerInterface $serializer): Response
    {
        $product = $productRepository->find($id);
        $json = $serializer->serialize($product, 'json');

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }
}
