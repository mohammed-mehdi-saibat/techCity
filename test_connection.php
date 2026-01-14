<?php

require_once 'vendor/autoload.php';

use Ycode\Library\Repositories\DatabaseConnection;
use Ycode\Library\Models\StudentMember;

try {

    $db = DatabaseConnection::getInstance();
    echo "Database Connection Successful!<br>";


    $expiry = new DateTime('2026-12-31');
    $student = new StudentMember(1, "Ycode", "test@techcity.edu", $expiry);

    echo "--- Member Logic Test ---<br>";
    echo "Name: " . $student->getFullName() . "<br>";
    echo "Max Books Allowed: " . $student->getMaxBooks() . " (Should be 3)<br>";
    echo "Loan Period: " . $student->getLoanPeriod() . " days (Should be 14)<br>";

    if ($student->canBorrow()) {
        echo "Member is eligible to borrow.<br>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
