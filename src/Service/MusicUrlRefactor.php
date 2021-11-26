<?php

namespace App\Service;

class MusicUrlRefactor
{
    public function musicUrlRefactor(string $musicUrl): string
    {
        $parameters = [''];
        if (str_starts_with($musicUrl, 'https://youtu.be/')) {
            $musicUrl = str_split($musicUrl, 17);
            $musicUrl = array_splice($musicUrl, -1);
            $musicUrl = implode($musicUrl);
        } elseif (str_starts_with($musicUrl, 'https://www.youtube.com/embed/')) {
            $musicUrl = str_split($musicUrl, 30);
            $musicUrl = array_splice($musicUrl, -1);
            $musicUrl = implode($musicUrl);
        } elseif (str_starts_with($musicUrl, 'https://www.youtube.com/watch?v=')) {
            $queryString = parse_url($musicUrl)['query'];
            parse_str($queryString, $parameters);
            $musicUrl = $parameters['v'];
        } else {
            $musicUrl = 'false';
        }
        return $musicUrl;
    }
}
