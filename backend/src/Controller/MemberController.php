<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Repository\MemberRepository;
use App\Repository\ShopRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MemberController extends AbstractController
{
    #[Route('/member/addFav', name: 'app_member_addFav')]
    #[IsGranted('ROLE_MEMBER')]
    public function addFav(Request $request,MemberRepository $memberRepository, ShopRepository $shopRepository): Response
    {
        $userId = $request->request->get('userId');
        $user = $memberRepository->find($userId);
        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $shopId = $request->request->get('shopId');
        $shop = $shopRepository->find($shopId);
        if (!$shop) {
            return new JsonResponse(['message' => 'Shop not found'], Response::HTTP_NOT_FOUND);
        }
        
        $user->addFavoriteShop($shop);
    }
    
}
