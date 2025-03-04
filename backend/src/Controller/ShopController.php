<?php

namespace App\Controller;

use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class ShopController extends AbstractController
{
    //obtenir la liste des magasion selon un type
    #[Route('/shops/{type}', name: 'app_shops_by_type')]
    public function shopsByType(string $type, ShopRepository $shopRepository, SerializerInterface $serializer): Response
    {
        $shops = $shopRepository->findBy(['type' => $type]);
        $json = $serializer->serialize($shops, 'json');

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    // Obtenir la liste des magasins
    #[Route('/shops', name: 'app_shops')]
    public function shopsList(ShopRepository $shopRepository, SerializerInterface $serializer): Response
    {
        $allShops = $shopRepository->findAll();
        $json = $serializer->serialize($allShops, 'json');

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
}
