<?php

namespace App\Controller;

class LeaderboardController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Leaderboard/leaderboard.html.twig');
    }
}
