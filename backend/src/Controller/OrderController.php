<?php
namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Repository\CartRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("/api/orders", name="create_order", methods={"POST"})
     */
    public function createOrder(Request $request, EntityManagerInterface $em, CartRepository $cartRepository, OrderRepository $orderRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $cart = $cartRepository->find($data['cartId']);

        if (!$cart) {
            return new JsonResponse(['error' => 'Cart not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $order = new Order();
        $order->setNumber(rand(100000, 999999)); // Set a random order number
        $order->setCreationDate(new \DateTime());
        $order->setAddressBill($data['address_bill']);
        if (isset($data['pickup_date'])) {
            $order->setPickupDate(new \DateTime($data['pickup_date']));
        }
        $order->setStatus('PENDING'); // Set initial status

        foreach ($cart->getCarts() as $cartItem) {
            $orderProduct = new OrderProduct();
            $orderProduct->setProduct($cartItem->getProductId());
            $orderProduct->setQuantity($cartItem->getQuantity());
            $orderProduct->setTotalPrice($cartItem->getProductId()->getPrice() * $cartItem->getQuantity());
            $orderProduct->setOrderId($order);
            $em->persist($orderProduct);
        }

        $em->persist($order);
        $em->flush();

        return new JsonResponse(['id' => $order->getId()], JsonResponse::HTTP_CREATED);
    }
}
