<?php // src/Controller/ProductController.php
namespace App\Controller;

use App\Entity\Product;
use App\Entity\SubCategory;
use App\Repository\ProductRepository;
use App\Repository\ShopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dom\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProductController extends AbstractController
{
    // Ajouter un produit
    #[Route('/api/products/create', name: 'app_add_product', methods: ['POST'])]
    #[IsGranted('ROLE_MERCHANT')]
    public function addProduct(Request $request, ShopRepository $shopRepository, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        // récupérer le id de la boutique
        $shop = $shopRepository->findOneBy(['merchantId' => $data['merchant']]);
        $product = new Product();
        $product->setName($data['name']);
        $product->setPrice($data['price']);
        $product->setDescription($data['description']);
        $product->setShop($shop);
        $product->setStock('En stock');
        // on donne une sous-categorie en fonction du nom 
        $cats = $entityManager->getRepository(SubCategory::class)->findBy(['name' => $data['subCategory']]);
        $product->setSubCategory($cats[0]);

        $entityManager->persist($product);
        $entityManager->flush();

        return new JsonResponse('Product created!', Response::HTTP_CREATED, [], true);
    }

    // Obtenir les produits d'un marchand
    #[Route('/products/merchant/{id}', name: 'app_products_merchant')]
    public function productsFromMerchant(int $id, ProductRepository $productRepository, SerializerInterface $serializer): Response
    {
        $products = $productRepository->findByMerchant($id);
        $json = $serializer->serialize($products, 'json');

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    // Obtenir les détails d'un produit
    #[Route('/products/{id}', name: 'app_product_detail', methods: ['GET'])]
    public function product(int $id, ProductRepository $productRepository, SerializerInterface $serializer): Response
    {
        $product = $productRepository->find($id);
        $json = $serializer->serialize($product, 'json');

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    // Obtenir les produits
    #[Route('/products', name: 'app_products', methods: ['GET'])]
    public function products(Request $request, ProductRepository $productRepository, SerializerInterface $serializer): Response
    {
        $filters = [];
        $params = $request->query->all();
        foreach ($params as $key => $value) {
            if($value != "null"){
                $filters[$key] = $value;
            }
        }

        if (count($filters) > 0) {
            $products = $productRepository->findByFilters($filters);
            $json = $serializer->serialize($products, 'json');
        }else{
            $allProducts = $productRepository->findAll();
            $json = $serializer->serialize($allProducts, 'json');
        }

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    // Mettre à jour un produit
    #[Route('/api/products/{id}', name: 'app_update_product', methods: ['PUT'])]
    #[IsGranted('ROLE_MERCHANT')]
    public function updateProduct(Request $request, ProductRepository $productRepository, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $product = $productRepository->find($data['id']);
        $product->setName($data['name']);
        $product->setPrice(floatval($data['price']));
        $product->setDescription($data['description']);
        $product->setStock($data['stock']);
        $entityManager->flush();

        return new JsonResponse('Product updated!', Response::HTTP_OK, [], true);
    }

    // Supprimer un produit
    #[Route('/api/products/{id}', name: 'app_delete_product', methods: ['DELETE'])]
    #[IsGranted('ROLE_MERCHANT')]
    public function deleteProduct(int $id, ProductRepository $productRepository, EntityManagerInterface $entityManager): Response
    {
        $product = $productRepository->find($id);
        $entityManager->remove($product);
        $entityManager->flush();

        return new JsonResponse('Product deleted!', Response::HTTP_OK, [], true);
    }
}
