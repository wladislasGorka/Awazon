<?php

namespace App\Controller;

use App\Entity\Member;
use App\Config\UsersRole;
use App\Config\UsersStatus;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class MemberRegistrationController extends AbstractController
{
    #[Route('/member/registration', name: 'app_member_registration')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em, JWTTokenManagerInterface $JWTManager): Response
    {
        $datas = json_decode($request->getContent(), true);

        // ... e.g. get the user data from a registration form
        $user = new Member();
        $user->setName($datas['name']);
        $user->setFirstName($datas['firstName']);
        $user->setEmail($datas['email']);
        $user->setPhone($datas['phone']);
        $user->setRegisterDate(new \DateTimeImmutable());
        $user->setLoginDate(new \DateTimeImmutable());
        $user->setEmailVerif(0);
        $user->setStatus(UsersStatus::enabled);
        $user->setRole(UsersRole::Member);
        $user->setRoles(['ROLE_USER', 'ROLE_MEMBER']);

        $plaintextPassword = $datas['password'];

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        $em->persist($user);
        $em->flush();

        return new JsonResponse(['message' => 'New Member create']);
    }
}
