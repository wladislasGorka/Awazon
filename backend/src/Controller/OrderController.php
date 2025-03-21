<?php
namespace App\Controller;

use App\Entity\Merchant;
use App\Entity\Order;
use App\Entity\OrderShop;
use App\Config\OrderStatus;
use App\Entity\OrderProduct;
use App\Config\OrderShopStatus;
use App\Repository\CartRepository;
use App\Repository\OrderRepository;
use App\Repository\OrderShopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    #[Route('/api/order/update', name:"api_update_order", methods:["PUT"])]
    #[IsGranted('ROLE_MERCHANT')]
    public function updateOrder(Request $request, OrderShopRepository $orderShopRepository, EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent(), true);

        $orderShop = $orderShopRepository->findOneOrderShop($data['id'],$data['userId']);
        $status = OrderShopStatus::from($data['status']);

        $orderShop->setStatus($status);

        $em->flush();

        return JsonResponse::fromJsonString("update order status: ok", Response::HTTP_OK);
    }

    #[Route('/order/create', name:"create_order", methods:["POST"])]
    public function createOrder(Request $request, EntityManagerInterface $em, CartRepository $cartRepository, OrderRepository $orderRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $carts = $cartRepository->findBy(['member' => $data['userId']]);

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
            $orderProduct->setProduct($cart->getProduct());
            $orderProduct->setQuantity($cart->getQuantity());
            $orderProduct->setTotalPrice($cart->getProduct()->getPrice() * $cart->getQuantity());
            $orderProduct->setOrderId($order);
            $em->persist($orderProduct);

            if(!in_array($cart->getProduct()->getShop(),$distinctShopInCarts)){
                array_push($distinctShopInCarts,$cart->getProduct()->getShopId());
            }            

            //On enlève le produit du panier
            $em->remove($cart);
        }

        foreach($distinctShopInCarts as $shop){
            $orderShop = new OrderShop();
            $orderShop->setStatus(OrderShopStatus::Pending);
            $orderShop->setShopId($shop);
            $orderShop->setOrderId($order);
            $em->persist($orderShop);
        }

        $em->persist($order);
        $em->flush();

        return new JsonResponse(['id' => $order->getId()], JsonResponse::HTTP_CREATED);
    }

    #[Route('/api/orders/merchant/{id}', name: 'app_orders', methods:['GET'])]
    #[IsGranted('ROLE_MERCHANT')]
    public function orders($id, OrderRepository $orderRepository, SerializerInterface $serializer): JsonResponse
    {
        $orders = $orderRepository->findAllByMerchant($id);
        $products = $orderRepository->findAllProductsByMerchant($id);

        $data = [
            'orders' => $orders,
            'products' => $products,
        ];

        $json = $serializer->serialize($data, 'json');

        return JsonResponse::fromJsonString($json, Response::HTTP_OK);
    }

    #[Route('/api/ordersStatus', name: 'app_orders_status', methods:['GET'])]
    #[IsGranted('ROLE_MERCHANT')]
    public function orderStatus(SerializerInterface $serializer): JsonResponse
    {
        $status = OrderShopStatus::array();
        $json = $serializer->serialize($status, 'json');
        return JsonResponse::fromJsonString($json, Response::HTTP_OK);
    }
}
