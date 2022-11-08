<?php

namespace App\Controller;

use App\Repository\MatchResumeRepository;
use App\Repository\MatchTimelineRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;


class GameTimelineController extends AbstractController
{
    #[Route('/game/timeline/{matchID}', name: 'app_game_timeline', methods: ['GET'])]
    public function gameTimelineByMatchID(MatchResumeRepository $MatchResumeRepository, MatchTimelineRepository $matchTimelineRepository, string $matchID): JsonResponse
    {

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/GameTimelineController.php',
        ]);
        // // Variables
        // $httpClient = HttpClient::create();

        // //Find match resume in database
        // $matchResume = $MatchResumeRepository->findOneBy(['matchID' => $matchID]);

        // //If match resume not found in database, send back a 404 error
        // if (empty($matchResume) || is_null($matchResume)) {
        //     return $this->json([
        //         'error' => 'Match resume not found',
        //     ], 404);
        // }

        // //Find match timeline in database
        // $matchTimeline = $matchTimelineRepository->findOneBy(['matchID' => $matchID]);

        // //If match timeline not found, we get it from Riot API
        // if (empty($matchTimeline) || is_null($matchTimeline)) {

        //     $raw = $httpClient->request('GET', 'https://europe.api.riotgames.com/lol/match/v5/matches/' . $matchID . '/timeline?api_key=' . $this->getParameter('app.riot_api_key'));
        //     $matchTimeline = json_decode($raw->getContent(), true);

        //     // $matchTimelineRepository->addMatchTimeline($matchTimeline);
        // }


        // return $this->json([
        //     'message' => 'Get timeline of a match',
        //     'matchID' => $matchID,
        //     'matchResume' => $matchResume,
        //     'matchTimeline' => $matchTimeline,
        // ]);
    }
}
