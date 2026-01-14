<?php

namespace Ycode\Library\Models;

class Book
{

    private array $authors = [];

    public function __construct(
        private string $isbn,
        private string $title,
        private int $publicationYear,
        private string $category,
        private string $status = 'Available'
    ) {}


    public function addAuthor(Author $author): void
    {
        $this->authors[] = $author;
    }


    public function getIsbn(): string
    {
        return $this->isbn;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getAuthors(): array
    {
        return $this->authors;
    }
    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getPublicationYear(): int
    {
        return $this->publicationYear;
    }
}
