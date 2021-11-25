<?php

namespace App\Service;

class MusicTitleOnlyCollector
{
    public function musicTitleOnlyCollector($musicTitleOnly): string
    {
        $musicTitleOnly = strstr($musicTitleOnly, '-');
        $musicTitleOnly = substr($musicTitleOnly, 0, strpos($musicTitleOnly, "("));
        $musicTitleOnly = substr($musicTitleOnly, 0, strpos($musicTitleOnly, "["));
        $musicTitleOnly = substr($musicTitleOnly, 0, strpos($musicTitleOnly, "ft"));
        $musicTitleOnly = substr($musicTitleOnly, 0, strpos($musicTitleOnly, "feat"));
        $musicTitleOnly = trim($musicTitleOnly,  '- ');
        return $musicTitleOnly;
    }
}
