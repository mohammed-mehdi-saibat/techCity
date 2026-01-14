<?php

namespace Ycode\Library\Services;

use Ycode\Library\Repositories\DatabaseConnection;
use Ycode\Library\Models\Member;
use Ycode\Library\Models\Book;
use PDO;
use Exception;
use DateTime;

class BorrowingService
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance();
    }

    public function borrowBook(Member $member, string $isbn, int $branchId): bool
    {
        if (!$member->canBorrow()) {
            throw new Exception("Member is not eligible to borrow (Expired or Fees > $10).");
        }

        try {

            $this->db->beginTransaction();

            $stmt = $this->db->prepare("
                SELECT available_copies FROM inventory 
                WHERE isbn = ? AND branch_id = ? FOR UPDATE
            ");
            $stmt->execute([$isbn, $branchId]);
            $inv = $stmt->fetch();

            if (!$inv || $inv['available_copies'] <= 0) {
                throw new Exception("Book not available at this branch.");
            }

            $borrowDate = new DateTime();
            $dueDate = (clone $borrowDate)->modify('+' . $member->getLoanPeriod() . ' days');

            $insert = $this->db->prepare("
                INSERT INTO borrow_records (member_id, isbn, branch_id, borrow_date, due_date)
                VALUES (?, ?, ?, ?, ?)
            ");
            $insert->execute([
                $member->getId(),
                $isbn,
                $branchId,
                $borrowDate->format('Y-m-d'),
                $dueDate->format('Y-m-d')
            ]);

            $update = $this->db->prepare("
                UPDATE inventory 
                SET available_copies = available_copies - 1 
                WHERE isbn = ? AND branch_id = ?
            ");
            $update->execute([$isbn, $branchId]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {

            $this->db->rollBack();
            throw $e;
        }
    }
}
