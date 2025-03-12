<?php

namespace App\Controller;

use App\Entity\ForumMessage;
use App\Entity\ForumSubject;
use App\Entity\ForumSection;
use App\Entity\User;
use App\Repository\ForumMessageRepository;
use App\Repository\ForumSubjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ForumController extends AbstractController
{
    #[Route('/subject', name: 'create_subject', methods: ['POST'])]
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

    #[Route('/subject', name: 'get_subject', methods: ['GET'])]
    public function getSubjects(ForumSubjectRepository $subjectRepo): JsonResponse
    {
        $subjects = $subjectRepo->findAll();
        $data = [];

        foreach ($subjects as $subject) {
            $data[] = [
                'id' => $subject->getId(),
                'name' => $subject->getName(),
                'forumSection' => $subject->getForumSection()->getName(),
                'user' => $subject->getUser()->getUsername(),
            ];
        }

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    #[Route('/message', name: 'create_message', methods: ['POST'])]
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

    #[Route('/message', name: 'get_message', methods: ['GET'])]
    public function getMessages(ForumMessageRepository $messageRepo): JsonResponse
    {
        $messages = $messageRepo->findAll();
        $data = [];

        foreach ($messages as $message) {
            $data[] = [
                'id' => $message->getId(),
                'message' => $message->getMessage(),
                'date_creation' => $message->getDateCreation()->format('Y-m-d H:i:s'),
                'user' => $message->getUser()->getUsername(),
                'forumSubject' => $message->getForumSubject()->getName(),
            ];
        }

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    #[Route('/section', name: 'create_section', methods: ['POST'])]
    public function createSection(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $section = new ForumSection();
        $section->setName($data['name']);

        $em->persist($section);
        $em->flush();

        return new JsonResponse(['id' => $section->getId()], JsonResponse::HTTP_CREATED);
    }

    #[Route('/section', name: 'get_section', methods: ['GET'])]
    public function getSections(EntityManagerInterface $em): JsonResponse
    {
        $sections = $em->getRepository(ForumSection::class)->findAll();
        $data = [];

        foreach ($sections as $section) {
            $data[] = [
                'id' => $section->getId(),
                'name' => $section->getName(),
            ];
        }

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}
