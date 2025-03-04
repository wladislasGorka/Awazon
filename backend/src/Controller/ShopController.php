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
    #[Route('/shops', name: 'app_shops')]
    public function shopsList(ShopRepository $shopRepository, SerializerInterface $serializer): Response
    {
        $allShops = $shopRepository->findAll();
        $json = $serializer->serialize($allShops, 'json');

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }
}
