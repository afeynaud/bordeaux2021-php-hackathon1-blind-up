<?php

namespace App\Service;

class MusicTitleCollector
{
    public function musicTitleCollector(string $videoId): string
    {
        $json = file_get_contents("https://noembed.com/embed?url=https://www.youtube.com/watch?v=" . $videoId);
        $data = json_decode($json);
        return $data->title;
    }
}
