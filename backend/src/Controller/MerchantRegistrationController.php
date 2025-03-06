<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Entity\Merchant;
use App\Config\UsersRole;
use App\Entity\FicheShop;
use App\Config\UsersStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class MerchantRegistrationController extends AbstractController
{
    #[Route('/merchant/registration', name: 'app_merchant_registration')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em): Response
    {
        $datas = json_decode($request->getContent(), true);

        // ... e.g. get the user data from a registration form
        $user = new Merchant();
        $user->setName($datas['name']);
        $user->setFirstName($datas['firstName']);
        $user->setEmail($datas['email']);
        $user->setPhone($datas['phone']);
        $user->setRegisterDate(new \DateTimeImmutable());
        $user->setLoginDate(new \DateTimeImmutable());
        $user->setEmailVerif(0);
        $user->setStatus(UsersStatus::enabled);
        $user->setRole(UsersRole::Merchant);
        $user->setRoles(['ROLE_USER', 'ROLE_MERCHANT']);
        // Merchant attributes
        $user->setAddress($datas['address']);
        // get a city
        $cities = $em->getRepository('App\Entity\City')->findAll(); 
        $city = $cities[array_rand($cities)];
        $user->setCity($city);

        $plaintextPassword = $datas['password'];
        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        $em->persist($user);
        $em->flush();

        // Creation of the shop
        $shop = new Shop();
        $shop->setName($datas['nameShop']);
        $shop->setSiret($datas['siret']);
        $shop->setAddress($datas['addressShop']);
        $shop->setCity($city);
        $shop->setOpenDate(new \DateTimeImmutable());
        $shop->setCreationDate(new \DateTimeImmutable());
        $shop->setMerchantId($user);

        $em->persist($shop);
        $em->flush();

        // Creation de la fiche shop
        $ficheShop = new FicheShop();
        $ficheShop->setName($datas['nameShop']);
        $ficheShop->setShop($shop);

        $em->persist($ficheShop);
        $em->flush();

        return new JsonResponse(['message' => 'New Merchant create']);
    }
}
