<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\SalesRepository;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

final class HomeController extends AbstractController
{    
    
    
    #[Route('/sales', name: 'sales')]
    public function index(Request $request,SalesRepository $salesRepository): JsonResponse
    {
        $sales = $salesRepository->findAll(); // Récupère toutes les promotions
        
        $data=[];
        foreach ($sales as $sale) {
            $images = [];
            foreach ($sale->getSalesImage() as $image) {
                $images[] = $image->getName();
            }
            $data[] = [
                'id' => $sale->getId(),
                'slogan' => $sale->getSlogan(),
                'description' => $sale->getDescription(),
                'pourcent' => $sale->getPourcent(),
                'date_start' => $sale->getDateStart()->format('Y-m-d'), // Formate la date
                'date_end' => $sale->getDateEnd()->format('Y-m-d'), // Formate la date
                'salesImages' => $images,
                'salesTarget' => $sale->getSalesTarget(),
                'shopId' => $sale->getShop()->getId(),
            ];
        }

        return new JsonResponse($data);
    }
    #[Route('/shop', name: 'shop')]
    public function getShops(Request $request, ShopRepository $shopRepository): JsonResponse
    {
        $shops = $shopRepository->findAll(); // Récupère tous les magasins

        $data = [];
        foreach ($shops as $shop) {
            $images = [];
            foreach ($shop->getImagesShop() as $image) {
                $images[] = $image->getPath(); // Récupère les noms des images
            }

            $data[] = [
                'id' => $shop->getId(),
                'name' => $shop->getName(),
                'logo' => $shop->getLogo(),
                'siret' => $shop->getSiret(),
                'address' => $shop->getAddress(),
                'longitude' => $shop->getLongitude(),
                'latitude' => $shop->getLatitude(),
                'phone' => $shop->getPhone(),
                'open_date' => $shop->getOpenDate()?->format('Y-m-d'), // Formate la date d'ouverture
                'creation_date' => $shop->getCreationDate()?->format('Y-m-d'), // Formate la date de création
                'status' => $shop->getStatus(),
                'paypal_account' => $shop->getPaypalAccount(),
                'type' => $shop->getType()?->name, // TypeShop
                'imagesShop' => $images,
                'city' => $shop->getCity()->getCityName(), // Nom de la ville
            ];
        }

        return new JsonResponse($data);
    }
    #[Route('/shops', name: 'shops')]
    public function getShopLocations(ShopRepository $shopRepository): JsonResponse
    {
        $shops = $shopRepository->findAll();

        $locations = [];
        foreach ($shops as $shop) {
            $locations[] = [
                'id' => $shop->getId(),
                'name' => $shop->getName(),
                'latitude' => $shop->getLatitude(),
                'longitude' => $shop->getLongitude(),
                'address' => $shop->getAddress(),
            ];
        }

        return new JsonResponse($locations);
    }
}