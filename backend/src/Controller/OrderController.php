<?php
namespace App\Controller;

use App\Config\OrderShopStatus;
use App\Entity\Order;
use App\Config\OrderStatus;
use App\Entity\OrderProduct;
use App\Entity\OrderShop;
use App\Repository\CartRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class OrderController extends AbstractController
{
    #[Route('/order/create', name:"create_order", methods:["POST"])]
    public function createOrder(Request $request, EntityManagerInterface $em, CartRepository $cartRepository, OrderRepository $orderRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $carts = $cartRepository->findBy(['memberId' => $data['userId']]);

        if (!$carts) {
            return new JsonResponse(['error' => 'Cart not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $order = new Order();
        $order->setNumber(rand(100000, 999999)); // Set a random order number
        $order->setCreationDate(new \DateTime());
        $order->setAddressBill($data['address_bill']);
        if (isset($data['pickup_date'])) {
            $order->setPickupDate(new \DateTime($data['pickup_date']));
        }
        $cities = $em->getRepository('App\Entity\City')->findAll(); 
        $city = $cities[array_rand($cities)];
        $order->setCity($city);
        $order->setStatus(OrderStatus::Pending); // Set initial status

        $distinctShopInCarts=[]; // Obtenir les boutiques concerné par la langue.
        foreach ($carts as $cart) {
            $orderProduct = new OrderProduct();
            $orderProduct->setProduct($cart->getProductId());
            $orderProduct->setQuantity($cart->getQuantity());
            $orderProduct->setTotalPrice($cart->getProductId()->getPrice() * $cart->getQuantity());
            $orderProduct->setOrderId($order);
            $em->persist($orderProduct);

            if(!in_array($cart->getProductId()->getShopId(),$distinctShopInCarts)){
                array_push($distinctShopInCarts,$cart->getProductId()->getShopId());
            }            

            //On enlève le produit du panier
            $em->remove($cart);
        }

        foreach($distinctShopInCarts as $shop){
            $orderShop = new OrderShop();
            $orderShop->setStatus(OrderShopStatus::Pending);
            $orderShop->setShop($shop);
            $orderShop->setOrderId($order);
            $em->persist($orderShop);
        }

        $em->persist($order);
        $em->flush();

        return new JsonResponse(['id' => $order->getId()], JsonResponse::HTTP_CREATED);
    }
}
