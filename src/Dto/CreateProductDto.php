<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateProductDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 6, max: 128)]
        public readonly string $name,

        #[Assert\NotBlank]
        #[Assert\GreaterThanOrEqual(1)]
        #[Assert\LessThanOrEqual(100)]
        public readonly int $qty,

        #[Assert\NotBlank]
        #[Assert\GreaterThanOrEqual(0)]
        #[Assert\LessThanOrEqual(10000)]
        public readonly float $price,
    ) {
    }
}