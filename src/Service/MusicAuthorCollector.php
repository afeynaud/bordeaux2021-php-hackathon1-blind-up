<?php

namespace App\Service;

class MusicAuthorCollector
{
    public function musicAuthorCollector(string $videoId): string
    {
        $json = file_get_contents("https://noembed.com/embed?url=https://www.youtube.com/watch?v=" . $videoId);
        $data = json_decode($json);
        return $data->author_name;
    }
}
