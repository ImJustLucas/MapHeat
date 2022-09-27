<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GamesResumeController extends AbstractController
{
    #[Route('/games/{username}', name: 'app_games_resume', methods: ['GET'])]
    public function index(string $username): JsonResponse
    {
        return $this->json([
            'message' => 'Get the resume of the last X games',
            'username' => $username,
        ]);
    }
}
