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
            header('Location: /game');
        }
        return $this->twig->render('Game/game.html.twig');
    }

    public function showGameDatas()
    {
        $gameManager = new GameManager();
        $countMusics = $gameManager->countMusics();
        $countMusics = (int)($countMusics);
        $randomId = rand(1, $countMusics);

        /*
        $randomId = explode(',', $randomId);
        $sameQuestionsId = $randomId;
        var_dump($sameQuestionsId);
        for ($i = 0; $i < $questionsNumber; $i++) {
            if (in_array($randomId, $sameQuestionsId) === false) {
                $randomId = rand(1, $countMusics);
                $sameQuestionsId = array_push($sameQuestionsId, $randomId);
            } else {
                $i--;
            }
        }
        var_dump($randomId);die;
        */

        $music = $gameManager->selectOneById($randomId);

        $questionResult = '';
        $playerAnswer = '';
        $gameAnswer = $gameManager->selectOneById($randomId);
        $gameAnswer = $gameAnswer['author'];
        $gameAnswer = str_replace(' ', '', $gameAnswer);
        $gameAnswer = strtolower($gameAnswer);
        $playerScore = 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $playerAnswer = str_replace(' ', '', $playerAnswer);
            $playerAnswer = strtolower($gameAnswer);
            if ($playerAnswer === $gameAnswer) {
                $playerScore += 100;
                $questionResult = 'Bonne réponse !';
            } else {
                $questionResult = 'Dommage !';
            }
        }
        return $this->twig->render('Game/game.html.twig', [
            'music' => $music,
            'questionResult' => $questionResult,

        ]);
    }

    public function showAll(): string
    {

        return $this->twig->render(
            'Game/welcome.html.twig',
        );
    }
}
