<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Ycode\Library\Repositories\DatabaseConnection;
use Ycode\Library\Repositories\MemberRepository;
use Ycode\Library\Services\BorrowingService;

$db = DatabaseConnection::getInstance();
$msg = "";

$members = $db->query("SELECT id, full_name, member_type FROM members")->fetchAll();
$branches = $db->query("SELECT id, name FROM branches")->fetchAll();
$isbn = $_GET['isbn'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $memberRepo = new MemberRepository();
        $service = new BorrowingService();

        $member = $memberRepo->findById($_POST['member_id']);
        $service->borrowBook($member, $_POST['isbn'], $_POST['branch_id']);

        $msg = "<div style='padding:15px; background:#d4edda; color:#155724; border-radius:4px; margin-bottom:20px;'>✅ Success! Book borrowed successfully.</div>";
    } catch (Exception $e) {
        $msg = "<div style='padding:15px; background:#f8d7da; color:#721c24; border-radius:4px; margin-bottom:20px;'>❌ Error: " . $e->getMessage() . "</div>";
    }
}
?>

<?php include 'header.php'; ?>

<h1>Confirm Loan</h1>
<?= $msg ?>

<form method="POST" style="background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
    <div style="margin-bottom: 15px;">
        <label><strong>Book ISBN:</strong></label><br>
        <input type="text" name="isbn" value="<?= htmlspecialchars($isbn) ?>" readonly style="background:#eee; width: 100%; max-width: 300px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label><strong>Select Member:</strong></label><br>
        <select name="member_id" required style="width: 100%; max-width: 320px; padding: 8px;">
            <?php foreach ($members as $m): ?>
                <option value="<?= $m['id'] ?>"><?= $m['full_name'] ?> (<?= $m['member_type'] ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label><strong>Library Branch:</strong></label><br>
        <select name="branch_id" required style="width: 100%; max-width: 320px; padding: 8px;">
            <?php foreach ($branches as $b): ?>
                <option value="<?= $b['id'] ?>"><?= $b['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Confirm Borrowing</button>
    <a href="index.php" style="margin-left: 10px; color: #666; text-decoration: none;">Back to Catalog</a>
</form>

</body>

</html>