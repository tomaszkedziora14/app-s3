<?php

// src/Controller/ExchangeController.php
namespace AppBundle\Controller;

use AppBundle\Entity\History;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;


class ExchangeController extends Controller
{
    /**
     * @Route("/exchange/values", methods={"GET", "POST"})
     */
    public function exchangeValues(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['message' => 'Invalid JSON data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        if (!isset($data['first']) || !isset($data['second'])) {
           return new Response('No required parameters: first i second', 400);
        }

            $first = (int)$data['first'];
            $second = (int)$data['second'];
            // Changing the value without an additional variable
            $first = $first + $second;
            $second = $first - $second;
            $first = $first - $second;

            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $history->setFirstIn($first);
            $history->setSecondIn($second);
            $history->setFirstOut($data['first']);
            $history->setSecondOut($data['second']);
            $history->setCreatedAt(new \DateTime());
            $history->setUpdatedAt(new \DateTime());

            $entityManager->persist($history);
            $entityManager->flush();

            return new JsonResponse(['message' => 'Values exchanged and saved in history']);

    }

    /**
     * @Route("/history/all", methods={"GET"})
     */
    public function getAllHistory(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $historyRepository = $entityManager->getRepository(History::class);

        $page = $request->query->getInt('page', 1);
        $limit = $request->query->getInt('limit', 10);
        $sortBy = $request->query->get('sort_by', 'createdAt');
        $sortOrder = $request->query->get('sort_order', 'desc');

        if (!in_array($sortOrder, ['asc', 'desc'])) {
            return new Response('Invalid sort_order. The available values ​​are "asc" lub "desc".', 400);
        }

        if (!in_array($sortBy, ['createdAt', 'firstIn', 'secondIn', 'firstOut', 'secondOut'])) {
            return new Response('Invalid sort_by. The available values ​​are "createdAt", "firstIn", "secondIn", "firstOut" or "secondOut".', 400);
        }

        if ($page < 1) {
            return new Response('The page number cannot be less than 1.', 400);
        }

        if ($limit < 1) {
            return new Response('The score limit cannot be less than 1.', 400);
        }

        $historyEntries = $historyRepository->findBySortingAndPagination($sortBy, $sortOrder, $page, $limit);

        $responseArray = [];

        foreach ($historyEntries as $entry) {
            $responseArray[] = [
                'id' => $entry->getId(),
                'firstIn' => $entry->getFirstIn(),
                'secondIn' => $entry->getSecondIn(),
                'firstOut' => $entry->getFirstOut(),
                'secondOut' => $entry->getSecondOut(),
                'createdAt' => $entry->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $entry->getUpdatedAt()->format('Y-m-d H:i:s'),
            ];
        }

          return new JsonResponse($responseArray);
    }
}
