<?php

namespace App\Service;

class MusicTitleOnlyCollector
{
    public function musicTitleOnlyCollector($musicTitleOnly): string
    {
        $needle = '';
        if (str_contains($musicTitleOnly, '[')) {
            $needle = '[';
        } elseif (str_contains($musicTitleOnly, '(')) {
            $needle = '(';
        } elseif (str_contains($musicTitleOnly, '[')) {
            $needle = '[';
        } elseif (str_contains($musicTitleOnly, 'ft')) {
            $needle = 'ft';
        } elseif (str_contains($musicTitleOnly, 'feat')) {
            $needle = 'feat';
        } elseif (str_contains($musicTitleOnly, 'Best')) {
            $needle = 'Best';
        }
        $musicTitleOnly = strstr($musicTitleOnly, '- ');
        $musicTitleOnly = substr($musicTitleOnly, 0, strpos($musicTitleOnly, $needle));
        $musicTitleOnly = trim($musicTitleOnly, '- ');
        return $musicTitleOnly;
    }
}
