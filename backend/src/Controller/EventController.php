<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\City;
use App\Entity\Merchant;
use App\Entity\Shop;
use App\Repository\EventRepository;
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
    // Récupérer les events
    #[Route('/events', name: 'app_event', methods: ['GET'])]
    public function getEvents(EventRepository $eventRepository, SerializerInterface $serializer): JsonResponse
    {
        $events = $eventRepository->findAll();

        $json = $serializer->serialize($events, 'json');

        return JsonResponse::fromJsonString($json, JsonResponse::HTTP_OK);
    }

    // Endpoint for creating an event
    #[Route('/events', name: 'create_event', methods: ['POST'])]
    public function createEvent(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $imageFile = $request->files->get('path_image');  // Get the uploaded file

        // Validate input
        if (!isset($data['date_start']) || !isset($data['date_end'])) {
            return $this->json(['error' => 'Missing date_start or date_end'], Response::HTTP_BAD_REQUEST);
        }

        if (!isset($data['city_name'])) {
            return $this->json(['error' => 'Missing city_name'], Response::HTTP_BAD_REQUEST);
        }
        // Fetch city by name
        $city = $entityManager->getRepository(City::class)->findById($data['city_name']);

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
        $event->setCity($city[0]);
        $event->setDateStart($dateStart);
        $event->setDateEnd($dateEnd);
        $event->setPathImage("");

        $merchant = $entityManager->getRepository(Merchant::class)->findOneBy(['id'=>$data['merchantId']]);
        $shops = $merchant->getShops();
        $event->setShop($shops[0]);

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
            'address' => $event->getAddress(),
            'shop_id' => $event->getShop(),
        ]);
    }

    #[Route('/events/{id}', name: 'get_event', methods: ['GET'])]
    public function getEvent(int $id, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $event = $entityManager->getRepository(Event::class)->find($id);

        if (!$event) {
            return $this->json(['error' => 'Event not found'], Response::HTTP_NOT_FOUND);
        }

        $eventData = $serializer->serialize($event, 'json', ['groups' => 'event:read']);

        return new JsonResponse($eventData, Response::HTTP_OK, [], true);
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
