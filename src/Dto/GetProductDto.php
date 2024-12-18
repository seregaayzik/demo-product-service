<?php

namespace App\Dto;

class GetProductDto
{
    public function __construct(
        public string $id,
        public string $name,
        public int $qty,
        public float $price,
        public float $income,
    ) {
    }
}