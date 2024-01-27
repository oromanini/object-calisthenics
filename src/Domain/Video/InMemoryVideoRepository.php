<?php

namespace Alura\Calisthenics\Domain\Video;

use Alura\Calisthenics\Domain\Student\Student;

class InMemoryVideoRepository implements VideoRepository
{
    private VideosCollection $videos;

    public function add(Video $video): void
    {
        $this->videos[] = $video;
    }

    public function videosFor(Student $student): array
    {
        $today = new \DateTimeImmutable();
        return array_filter(
            array: $this->videos->list(),
            callback: fn (Video $video) => $video->getAgeLimit() <= $student->age()
        );
    }
}
