<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\City;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class EventController extends AbstractController
{
    // Endpoint for creating an event
    #[Route('/events', name: 'create_event', methods: ['POST'])]
    public function createEvent(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = $request->request->all();
        $imageFile = $request->files->get('path_image');  // Get the uploaded file

        // Validate input
        if (!isset($data['date_start']) || !isset($data['date_end'])) {
            return $this->json(['error' => 'Missing date_start or date_end'], Response::HTTP_BAD_REQUEST);
        }

        if (!isset($data['city_name'])) {
            return $this->json(['error' => 'Missing city_name'], Response::HTTP_BAD_REQUEST);
        }

        // Fetch city by name
        $city = $entityManager->getRepository(City::class)->findOneBy(['city_name' => $data['city_name']]);

        if (!$city) {
            return $this->json(['error' => 'City not found'], Response::HTTP_BAD_REQUEST);
        }

        // Process the date fields
        try {
            $dateStart = new \DateTime($data['date_start']);
            $dateEnd = new \DateTime($data['date_end']);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Invalid date format'], Response::HTTP_BAD_REQUEST);
        }

        // Handle file upload
        $imagePath = null;
        if ($imageFile instanceof UploadedFile) {
            $uploadDirectory = $this->getParameter('images_directory');
            $newFilename = uniqid().'.'.$imageFile->guessExtension();

            try {
                $imageFile->move($uploadDirectory, $newFilename);
                $imagePath = $newFilename;
            } catch (FileException $e) {
                return $this->json(['error' => 'File upload error: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        // Create event entity
        $event = new Event();
        $event->setTitle($data['title'] ?? 'Untitled Event');
        $event->setDescription($data['description'] ?? '');
        $event->setAddress($data['address'] ?? '');
        $event->setCity($city);
        $event->setDateStart($dateStart);
        $event->setDateEnd($dateEnd);
        $event->setPathImage($imagePath);

        // Save event in DB
        $entityManager->persist($event);
        $entityManager->flush();

        // Return created event
        return $this->json([
            'id' => $event->getId(),
            'title' => $event->getTitle(),
            'description' => $event->getDescription(),
            'date_start' => $event->getDateStart()->format('Y-m-d H:i:s'),
            'date_end' => $event->getDateEnd()->format('Y-m-d H:i:s'),
            'path_image' => $event->getPathImage(),
            'city' => $event->getCity()->getCityName(),
        ]);
    }

    // Endpoint for fetching city
    #[Route('/city', name: 'get_city', methods: ['GET'])]
    public function getCity(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $city = $entityManager->getRepository(City::class)->findAll();

        $cityData = $serializer->serialize($city, 'json', ['groups' => 'city:read']);

        return new JsonResponse($cityData, Response::HTTP_OK, [], true);
    }
}
