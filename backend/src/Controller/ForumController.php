<?php

namespace App\Controller;

use App\Entity\ForumMessage;
use App\Entity\ForumSubject;
use App\Entity\ForumSection;
use App\Repository\ForumMessageRepository;
use App\Repository\ForumSubjectRepository;
use App\Repository\ForumSectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class ForumController extends AbstractController
{
   

    #[Route('/forum-section/{id}', name: 'get_section_by_id', methods: ['GET'])]
    public function getSectionById(int $id, ForumSectionRepository $ForumSectionRepository, SerializerInterface $serializer): JsonResponse
    {$section=$ForumSectionRepository->find($id);

        $json = $serializer->serialize($section, 'json');
        return new JsonResponse($json, JsonResponse::HTTP_OK, [], true);
    }


    #[Route('/forum-subject/{id}', name: 'get_subject_by_id', methods: ['GET'])]
    public function getSubjectById(int $id, ForumSubjectRepository $ForumSubjectRepository, SerializerInterface $serializer): JsonResponse
    {$subject=$ForumSubjectRepository->find($id);
       $json = $serializer->serialize($subject, 'json');
        return new JsonResponse($json, JsonResponse::HTTP_OK, [], true);
    }


    #[Route('/forum-message/{id}', name: 'get_message_by_id', methods: ['GET'])]
    public function getMessageById(int $id, ForumMessageRepository $ForumMessageRepository, SerializerInterface $serializer): JsonResponse
    {$message=$ForumMessageRepository->find($id);
        $json = $serializer->serialize($message, 'json');
        return new JsonResponse($json, JsonResponse::HTTP_OK, [], true);
    }


    #[Route('/forum-section', name: 'create_section', methods: ['POST'])]
    public function createSection(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $section = new ForumSection();
        $section->setName($data['name']);
        $em->persist($section);
        $em->flush();
        return new JsonResponse(['id' => $section->getId()], JsonResponse::HTTP_CREATED);
    }

    #[Route('/forum-subject', name: 'create_subject', methods: ['POST'])]
    public function createSubject(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $subject = new ForumSubject();
        $subject->setName($data['name']);
        $subject->setUser($this->getUser());
        $em->persist($subject);
        $em->flush();
        return new JsonResponse(['id' => $subject->getId()], JsonResponse::HTTP_CREATED);
    }

    #[Route('/forum-message', name: 'create_message', methods: ['POST'])]
    public function createMessage(Request $request, ForumSubjectRepository $subjectRepo, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $subject = $subjectRepo->find($data['subject_id']);
        if (!$subject) {
            return new JsonResponse(['error' => 'Subject not found'], JsonResponse::HTTP_NOT_FOUND);
        }
        $message = new ForumMessage();
        $message->setMessage($data['message']);
        $message->setDateCreation(new \DateTime());
        $message->setForumSubject($subject);
        $message->setUser($this->getUser());
        $em->persist($message);
        $em->flush();
        return new JsonResponse(['id' => $message->getId()], JsonResponse::HTTP_CREATED);
    }
}