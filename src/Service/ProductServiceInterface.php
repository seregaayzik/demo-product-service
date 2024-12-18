<?php

namespace App\Service;

use App\Dto\CreateProductDto;
use App\Dto\GetProductDto;

interface ProductServiceInterface
{
    public function postProduct(CreateProductDto $productDto):GetProductDto;
    public function getProduct(string $uuid):?GetProductDto;
    public function increaseIncome(string $uuid,float $income):void;
    public function getProducts():Iterable;
}