<?php
namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Entity\Member;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CartController extends AbstractController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    #[Route('/cart', name: 'create_cart', methods: ['POST'])]
    public function createCart(Request $request, EntityManagerInterface $em, ProductRepository $productRepository, MemberRepository $memberRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $product = $productRepository->find($data['productId']);
        if (!$product) {
            return new JsonResponse(['error' => 'Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $member = $memberRepository->find($data['memberId']);
        if (!$member) {
            return new JsonResponse(['error' => 'Member not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $cart = new Cart();
        $cart->setQuantity($data['quantity']);
        $cart->setAddTime(new \DateTime());
        $cart->setProductId($product);
        $cart->setMemberId($member);

        $em->persist($cart);
        $em->flush();

        $json = $this->serializer->serialize($product, 'json');

        return new JsonResponse(['id' => $cart->getId(), 'product' => $json], JsonResponse::HTTP_CREATED);
    }

    #[Route('/cart/{id}', name: 'get_cart', methods: ['GET'])]
    public function getCartByMember(int $id, CartRepository $cartRepository): JsonResponse
    {
        $carts = $cartRepository->findByProduct($id);
        $json = $this->serializer->serialize($carts, 'json');

        return new JsonResponse($json, JsonResponse::HTTP_OK, [], true);
    }

    #[Route('/cart', name: 'update_cart', methods: ['PUT'])]
    public function updateCart(Request $request, EntityManagerInterface $em, CartRepository $cartRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $cart = $cartRepository->find($data['id']);
        if (!$cart) {
            return new JsonResponse(['error' => 'Cart not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $cart->setQuantity($data['quantity']);
        $em->flush();

        return new JsonResponse(['id' => $cart->getId(), 'quantity' => $cart->getQuantity()], JsonResponse::HTTP_OK);
    }

    #[Route('/cart/{id}', name: 'delete_cart', methods: ['DELETE'])]
    public function deleteCart(int $id, EntityManagerInterface $em, CartRepository $cartRepository): JsonResponse
    {
        $cart = $cartRepository->find($id);
        if (!$cart) {
            return new JsonResponse(['error' => 'Cart not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $em->remove($cart);
        $em->flush();

        return new JsonResponse(['message' => 'Cart item removed'], JsonResponse::HTTP_OK);
    }
}
