<?php

namespace App\Controller;

use App\Entity\Hook;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class EchoController extends AbstractController
{
    #[Route(path: 'echo', name: 'echo', methods: ['GET', 'POST'])]
    public function index(Request $request, LoggerInterface $logger, EntityManagerInterface $entityManager): JsonResponse
    {
        $query = $request->query->all();
        $body = $request->toArray();

        $hook = new Hook();
        $hook->setBody($body);
        $hook->setQueryParams($query);


        $entityManager->persist($hook);
        $entityManager->flush();

        $logger->info("Receive hook", ['queryParams' => $query, 'body' => $body]);

        return new JsonResponse($body);
    }
}