<?php

namespace App\Repository;

use App\Dto\CreateProductDto;
use App\Entity\Product;

interface ProductRepositoryInterface
{
    public function getProduct(string $uuid):?Product;
    public function getProducts():Iterable;
}