<?php

namespace Ycode\Library\Repositories;

use Ycode\Library\Models\Member;
use Ycode\Library\Models\StudentMember;
use Ycode\Library\Models\FacultyMember;
use PDO;
use DateTime;

class MemberRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance();
    }

    public function findById(int $id): ?Member
    {
        $stmt = $this->db->prepare("SELECT * FROM members WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        $expiry = new DateTime($row['membership_expiry']);

        if ($row['member_type'] === 'Student') {
            return new StudentMember(
                $row['id'],
                $row['full_name'],
                $row['email'],
                $expiry,
                (float)$row['unpaid_fees']
            );
        } else {
            return new FacultyMember(
                $row['id'],
                $row['full_name'],
                $row['email'],
                $expiry,
                (float)$row['unpaid_fees']
            );
        }
    }
}
