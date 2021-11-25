<?php

namespace App\Controller;

use App\Model\GameManager;
use App\Service\MusicTitleCollector;
use App\Service\MusicTitleOnlyCollector;
use App\Service\MusicAuthorCollector;
use App\Service\MusicAuthorRefactor;
use App\Service\MusicUrlRefactor;

class GameController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Game/game.html.twig');
    }

    public function add()
    {
        $gameManager = new GameManager();
        $musicTitleCollector = new MusicTitleCollector();
        $musicTitleOnlyCollector = new MusicTitleOnlyCollector();
        $musicAuthorCollector = new MusicAuthorCollector();
        $musicAuthorRefactor = new MusicAuthorRefactor();
        $musicUrlRefactor = new MusicUrlRefactor();
        $urlError = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $music = array_map('trim', $_POST);
            $musicUrl = $music['url'];
            $musicUrlRefactor->musicUrlRefactor($musicUrl);
            $music['url'] = $musicUrlRefactor->musicUrlRefactor($musicUrl);
            if ($music['url'] === 'false') {
                $urlError = 'Ce lien Youtube n\'est pas valide';
            } else {
                $videoId = $music['url'];
                $musicTitleCollector->musicTitleCollector($videoId);
                $music['title'] = $musicTitleCollector->musicTitleCollector($videoId);
                $musicTitleOnly = $music['title'];
                $music['title_only'] = $musicTitleOnlyCollector->musicTitleOnlyCollector($musicTitleOnly);
                $musicAuthorCollector->musicAuthorCollector($videoId);
                $music['author'] = $musicAuthorCollector->musicAuthorCollector($videoId);
                $authorRefactor = $music['author'];
                $music['author'] = $musicAuthorRefactor->musicAuthorRefactor($authorRefactor);
                $gameManager->insert($music);
            }
            header('Location: /');
        }
        return $this->twig->render('Game/game.html.twig');
    }

    public function showGameDatas()
    {
        $gameManager = new GameManager();
        $music = $gameManager->selectOneById(4);
        return $this->twig->render('Game/game.html.twig', [
            'music' => $music,
        ]);
    }
}
