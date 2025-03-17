<?php

namespace App\Controller;

use App\Repository\SalesRepository;
use App\Repository\ShopRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

final class HomeController extends AbstractController

{
    #[Route('/sales', name: 'sales', methods: ['GET'])]
    public function index( SalesRepository $salesRepository): JsonResponse
    {
        try {
            $sales = $salesRepository->findAll();
           // Récupère toutes les promotions
            
            if (!$sales) {
                return new JsonResponse(['message' => 'Aucune promotion trouvée'], Response::HTTP_NOT_FOUND);
            }

            $data = [];
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
                    'date_start' => $sale->getDateStart()?->format('Y-m-d'), // Formate la date
                    'date_end' => $sale->getDateEnd()?->format('Y-m-d'), // Formate la date
                    'salesImages' => $images,
                    'salesTarget' => $sale->getSalesTarget(),
                    'shopId' => $sale->getShop()->getId(),
                ];
            }

            return new JsonResponse($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            // Log l'erreur pour un meilleur suivi
            error_log($e->getMessage());
            return new JsonResponse(['error' => 'Une erreur interne est survenue'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/shop', name: 'shop', methods: ['GET'])]
    public function getShops(ShopRepository $shopRepository): JsonResponse
    {
        try {
            $shops = $shopRepository->findAll(); // Récupère tous les magasins

            if (!$shops) {
                return new JsonResponse(['message' => 'Aucun magasin trouvé'], Response::HTTP_NOT_FOUND);
            }

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
                    'open_date' => $shop->getOpenDate()?->format('Y-m-d'), 
                    'creation_date' => $shop->getCreationDate()?->format('Y-m-d'), 
                    'status' => $shop->getStatus(),
                    'paypal_account' => $shop->getPaypalAccount(),
                    'type' => $shop->getType()?->name, // TypeShop
                    'imagesShop' => $images,
                    'city' => $shop->getCity()?->getCityName(), 
                ];
            }

            return new JsonResponse($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return new JsonResponse(['error' => 'Une erreur interne est survenue'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('/product', name: 'products', methods: ['GET'])]
    public function getProducts(ProductRepository $productRepository): JsonResponse
    {
        try {
            $products = $productRepository->findAll(); // Récupère tous les produits
    
            if (!$products) {
                return new JsonResponse(['message' => 'Aucun produit trouvé'], Response::HTTP_NOT_FOUND);
            }
          
            $data = [];
            foreach ($products as $product) {
                $images = [];
                foreach ($product->getProductImage() as $image) {
                    $images[] = $image->getName(); // Récupère les noms des images
                }
                
                $data[] = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'description' => $product->getDescription(),
                    'price' => $product->getPrice(),
                    'stock' => $product->getStock(),
                    'category' => $product->getSubCategory()?->getName(), 
                    'images' => $image, // Images du produit!!
                ];
            }
    
            return new JsonResponse($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return new JsonResponse(['error' => 'Une erreur interne est survenue'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    
    }

