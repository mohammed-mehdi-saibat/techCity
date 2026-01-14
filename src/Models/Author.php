<?php

namespace Ycode\Library\Models;

class Author
{
    public function __construct(
        private int $id,
        private string $name,
        private ?string $biography = null
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
