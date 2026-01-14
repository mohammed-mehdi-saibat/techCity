<?php
require_once 'vendor/autoload.php';

use Ycode\Library\Repositories\BookRepository;

$repo = new BookRepository();

echo "Searching for 'Clean':<br>";
$results = $repo->search('Clean');

foreach ($results as $book) {
    echo "Found: " . $book->getTitle() . " (" . $book->getCategory() . ")<br>";
}

echo "<br>Searching for 'Robert' (Author):<br>";
$authorResults = $repo->search('Robert');
foreach ($authorResults as $book) {
    echo "Found: " . $book->getTitle() . " by " . $book->getAuthors()[0]->getName() . "<br>";
}
