<?php

namespace Ycode\Library\Models;

class LibraryBranch
{
    public function __construct(
        private int $id,
        private string $name,
        private string $location
    ) {}

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
}
