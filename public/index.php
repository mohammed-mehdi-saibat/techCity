<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Ycode\Library\Repositories\BookRepository;

$repo = new BookRepository();
$searchQuery = $_GET['q'] ?? '';

$books = !empty($searchQuery) ? $repo->search($searchQuery) : [];
?>

<?php include 'header.php'; ?>

<h1>Library Catalog</h1>

<form action="index.php" method="GET" style="margin-bottom: 2rem;">
    <input type="text" name="q" placeholder="Search by title, author, or category..." value="<?= htmlspecialchars($searchQuery) ?>">
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<table border="0" width="100%" style="border-collapse: collapse;">
    <thead>
        <tr style="border-bottom: 2px solid #eee; text-align: left;">
            <th>ISBN</th>
            <th>Title</th>
            <th>Authors</th>
            <th>Category</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($books)): ?>
            <tr>
                <td colspan="5">Search for a book to see results.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($books as $book): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td><?= $book->getIsbn() ?></td>
                    <td><strong><?= $book->getTitle() ?></strong></td>
                    <td>
                        <?php foreach ($book->getAuthors() as $author) echo $author->getName() . " "; ?>
                    </td>
                    <td><?= $book->getCategory() ?></td>
                    <td>
                        <span class="status-badge <?= $book->isAvailable() ? 'available' : 'checked-out' ?>">
                            <?= $book->getStatus() ?>
                        </span>
                        <?php if ($book->isAvailable()): ?>
                            <a href="borrow.php?isbn=<?= $book->getIsbn() ?>" class="btn btn-primary" style="font-size: 0.7rem; margin-left: 10px;">Borrow</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</body>

</html>