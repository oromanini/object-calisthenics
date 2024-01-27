<?php

namespace Alura\Calisthenics\Domain\Student;

use Alura\Calisthenics\Domain\Video\Video;
use DateTimeInterface;
use Ds\Map;

class WatchedVideos
{
    private Map $videos;

    public function __construct()
    {
        $this->videos = new Map();
    }

    public function add(Video $video, \DateTimeInterface $dateTime): void
    {
        $this->videos->put($video, $dateTime);
    }

    public function count(): int
    {
        return $this->videos->count();
    }

    public function dateOfFirstVideo(): \DateTimeInterface
    {
        $this->videos
            ->sort(
                fn(DateTimeInterface $dateA, DateTimeInterface $dateB)
                    => $dateA <=> $dateB
        );

        return $this->videos->first()->value;
    }
}