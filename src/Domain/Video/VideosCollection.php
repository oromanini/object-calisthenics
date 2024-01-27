<?php

namespace Alura\Calisthenics\Domain\Video;

class VideosCollection
{
    private array $videos = [];

    public function add(Video $video): void
    {
        $this->videos[] = $video;
    }

    public function list(): array
    {
        return $this->videos;
    }
}