<?php

namespace App\Message;

final class UpdateProductIncomeMessage
{
    public function __construct(
        public string $uuid,
        public float $income
    ) {
    }

    public function getUUid(): string
    {
        return $this->uuid;
    }
    public function getIncome(): float
    {
        return $this->income;
    }
}
