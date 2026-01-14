<?php

namespace Ycode\Library\Models;

class FacultyMember extends Member
{
    public function getMaxBooks(): int
    {
        return 10;
    }
    public function getLoanPeriod(): int
    {
        return 30;
    }
    public function getLateFeeRate(): float
    {
        return 0.25;
    }
}
