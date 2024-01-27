<?php

namespace Alura\Calisthenics\Domain\Student;

class FullName
{
    public function __construct(
        private string $lastName,
        private string $firstName
    ) {
    }

    public function __toString(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }
}