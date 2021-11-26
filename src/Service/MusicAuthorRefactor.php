<?php

namespace App\Service;

class MusicAuthorRefactor
{
    public function musicAuthorRefactor($authorRefactor): string
    {
        $musicAuthorRefactor = trim($authorRefactor, 'VEVO');
        return $musicAuthorRefactor;
    }
}
