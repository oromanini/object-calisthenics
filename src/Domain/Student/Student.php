<?php

namespace Alura\Calisthenics\Domain\Student;

use Alura\Calisthenics\Domain\Email\Email;
use Alura\Calisthenics\Domain\Video\Video;
use DateTimeInterface;

class Student
{
    private Email $email;
    private DateTimeInterface $birthdate;
    private WatchedVideos $watchedVideos;
    public Address $address;
    private FullName $fullName;

    public function __construct(
        FullName $fullName,
        Email $email,
        DateTimeInterface $birthdate,
        Address $address
    ) {
        $this->watchedVideos = new WatchedVideos();
        $this->email = $email;
        $this->birthdate = $birthdate;
        $this->fullName = $fullName;
        $this->address = $address;
    }

    public function fullName(): string
    {
        return (string) $this->fullName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function birthdate(): DateTimeInterface
    {
        return $this->birthdate;
    }

    public function watch(Video $video, DateTimeInterface $date): void
    {
        $this->watchedVideos->add($video, $date);
    }

    public function hasAccess(): bool
    {
        if ($this->watchedVideos->count() === 0) {
            return true;
        }

        $firstDate = $this->watchedVideos->dateOfFirstVideo();
        $today = new \DateTimeImmutable();

        return $firstDate->diff($today)->days < 90;
    }

    public function age(): int
    {
        $today = new \DateTimeImmutable();
        return $this->birthdate->diff($today)->y;
    }
}
