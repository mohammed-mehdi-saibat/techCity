<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Ycode\Library\Repositories\DatabaseConnection;
use Ycode\Library\Repositories\MemberRepository;
use Ycode\Library\Services\BorrowingService;

$db = DatabaseConnection::getInstance();
$msg = "";

// 1. Fetch Members and Branches for the dropdowns
$members = $db->query("SELECT id, full_name, member_type FROM members")->fetchAll();
$branches = $db->query("SELECT id, name FROM branches")->fetchAll();
$isbn = $_GET['isbn'] ?? '';

// 2. Handle the Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $memberRepo = new MemberRepository();
        $service = new BorrowingService();

        $member = $memberRepo->findById($_POST['member_id']);
        $service->borrowBook($member, $_POST['isbn'], $_POST['branch_id']);

        $msg = "<div class='status-badge available'>Success! Book borrowed.</div>";
    } catch (Exception $e) {
        $msg = "<div class='status-badge checked-out'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<?php include 'header.php'; ?>

<h1>Borrow a Book</h1>
<?= $msg ?>

<form method="POST" style="margin-top: 20px;">
    <div style="margin-bottom: 15px;">
        <label>Book ISBN:</label><br>
        <input type="text" name="isbn" value="<?= htmlspecialchars($isbn) ?>" readonly>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Select Member:</label><br>
        <select name="member_id" required style="padding: 8px; width: 315px;">
            <?php foreach ($members as $m): ?>
                <option value="<?= $m['id'] ?>"><?= $m['full_name'] ?> (<?= $m['member_type'] ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Select Branch:</label><br>
        <select name="branch_id" required style="padding: 8px; width: 315px;">
            <?php foreach ($branches as $b): ?>
                <option value="<?= $b['id'] ?>"><?= $b['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Confirm Borrowing</button>
    <a href="index.php" class="btn" style="color: #666;">Cancel</a>
</form>

</body>

</html>