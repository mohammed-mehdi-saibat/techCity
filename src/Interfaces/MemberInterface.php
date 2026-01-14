<?php

namespace Ycode\Library\Interfaces;

interface MemberInterface
{
    public function getMaxBooks(): int;
    public function getLoanPeriod(): int;
    public function getLateFeeRate(): float;
}
