<?php

namespace App\Controller;

use App\Repository\CategoryShopRepository;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class ShopController extends AbstractController
{
    // Obtenir les produits d'un magasin
    #[Route('/shops/{id}/products', name: 'app_shop_products')]
    public function shopProducts(int $id, ShopRepository $shopRepository, SerializerInterface $serializer): Response
    {
        $shop = $shopRepository->find($id);
        $products = $shop->getProducts();
        $json = $serializer->serialize($products, 'json');

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    // Obtenir les détails d'un magasin
    #[Route('/shops/{id}', name: 'app_shop_detail')]
    public function shop(int $id, ShopRepository $shopRepository, SerializerInterface $serializer): Response
    {
        $shop = $shopRepository->find($id);
        $json = $serializer->serialize($shop, 'json');

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    // Obtenir la liste des magasins, prends en compte les paramètres de la requête
    #[Route('/shops', name: 'app_shops')]
    public function shopsList(Request $request, ShopRepository $shopRepository, SerializerInterface $serializer): Response
    {
        $filters = [];
        $params = $request->query->all();
        foreach ($params as $key => $value) {
            if($value != "null"){
                $filters[$key] = $value;
            }
        }
        
        if (count($filters) > 0) {
            //$shops = $shopRepository->findBy(['type' => $type]);
            $shops = $shopRepository->findByFilters($filters);
            $json = $serializer->serialize($shops, 'json');
        }else{
            $allShops = $shopRepository->findAll();
            $json = $serializer->serialize($allShops, 'json');
        }

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }    

    // Obtiner les types de magasins
    #[Route('/shops-types', name: 'app_shop_types')]
    public function shopTypes(ShopRepository $shopRepository): Response
    {
        $types = $shopRepository->getTypes();
        $types = array_map(fn($type) => $type['type'], $types);

        return new JsonResponse($types, Response::HTTP_OK);
    }

    // Obtenir les catégories de magasins
    #[Route('/shops-categories', name: 'app_shop_categories')]
    public function shopCategories(CategoryShopRepository $categoryShopRepository, SerializerInterface $serializer): Response
    {
        $categories = $categoryShopRepository->findAll();
        $categories = array_map(fn($category) => $category->getName(), $categories);

        return new JsonResponse($categories, Response::HTTP_OK);
    }
}
