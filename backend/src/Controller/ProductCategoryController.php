<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\SubCategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ProductCategoryController extends AbstractController
{    
    // Obtenir les sous-catégories d'une catégorie
    #[Route('/products/category/smart', name: 'app_product_smart_category', methods: ['GET'])]
    public function smartCategories(CategoryRepository $CategoryRepository, SerializerInterface $serializer): JsonResponse
    {
        $categories = $CategoryRepository->findCategoriesAndSubCategories();
        $catNames = [];
        foreach ($categories as $item) {
            $category = $item['category'];
            $subCategory = $item['subCategory'];
        
            if (!isset($catNames[$category])) {
                $catNames[$category] = [];
            }
        
            if (!in_array($subCategory, $catNames[$category])) {
                $catNames[$category][] = $subCategory;
            }
        }
        $json = $serializer->serialize($catNames, 'json', [
            'json_encode_options' => JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        ]);
        return new JsonResponse($json, Response::HTTP_OK);
    }

    // Obtenir les catégories de produits
    #[Route('/products/category', name: 'app_product_category', methods: ['GET'])]
    public function categories(CategoryRepository $categoryRepository): JsonResponse
    {
        $categories = $categoryRepository->findNames();
        $categories = array_map(fn($category) => $category['name'], $categories);

        return new JsonResponse($categories, Response::HTTP_OK);
    }

    // Obtenir les sous-catégories
    #[Route('/products/sub-category', name: 'app_product_sub_category', methods: ['GET'])]
    public function subCategories(SubCategoryRepository $subCategoryRepository): JsonResponse
    {
        $categories = $subCategoryRepository->findNames();
        $categories = array_map(fn($category) => $category['name'], $categories);

        return new JsonResponse($categories, Response::HTTP_OK);
    }


}
