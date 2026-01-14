<?php

namespace Ycode\Library\Repositories;

use Ycode\Library\Models\Book;
use Ycode\Library\Models\Author;
use PDO;

class BookRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance();
    }

    public function findByIsbn(string $isbn): ?Book
    {
        $stmt = $this->db->prepare("
            SELECT b.*, a.id as author_id, a.name as author_name 
            FROM books b
            LEFT JOIN book_authors ba ON b.isbn = ba.isbn
            LEFT JOIN authors a ON ba.author_id = a.id
            WHERE b.isbn = ?
        ");
        $stmt->execute([$isbn]);
        $results = $stmt->fetchAll();

        if (!$results) return null;

        $book = new Book(
            $results[0]['isbn'],
            $results[0]['title'],
            $results[0]['publication_year'],
            $results[0]['category'],
            $results[0]['status']
        );

        foreach ($results as $row) {
            if ($row['author_id']) {
                $author = new Author($row['author_id'], $row['author_name']);
                $book->addAuthor($author);
            }
        }

        return $book;
    }
}
