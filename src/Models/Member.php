<?php

namespace Ycode\Library\Models;

use Ycode\Library\Interfaces\MemberInterface;
use DateTime;

abstract class Member implements MemberInterface
{
    public function __construct(
        protected int $id,
        protected string $fullName,
        protected string $email,
        protected DateTime $membershipExpiry,
        protected float $unpaidFees = 0.0
    ) {}


    public function isMembershipValid(): bool
    {
        return new DateTime() < $this->membershipExpiry;
    }

    public function canBorrow(): bool
    {
        return $this->isMembershipValid() && $this->unpaidFees <= 10.0;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getFullName(): string
    {
        return $this->fullName;
    }
    public function getUnpaidFees(): float
    {
        return $this->unpaidFees;
    }
}
