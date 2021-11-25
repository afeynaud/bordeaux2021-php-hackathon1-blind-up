<?php

namespace App\Controller;

class GameController extends AbstractController
{
    public function showAll(): string
    {

        return $this->twig->render(
            'Game/welcome.html.twig',
        );
    }
}
