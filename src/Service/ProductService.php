<?php

namespace App\Service;

use App\Dto\CreateProductDto;
use App\Dto\GetProductDto;
use App\Entity\Product;
use App\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Uid\Uuid;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly EntityManagerInterface $entityManager
    ){}
    public function increaseIncome(string $uuid,float $income):void
    {
        $product = $this->productRepository->getProduct(Uuid::fromString($uuid)->toBinary());
        if (!$product) {
            throw new NotFoundHttpException('Product not found.');
        }
        $newIncome = $product->getIncome() + $income;
        $product->setIncome($newIncome);
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
    public function postProduct(CreateProductDto $productDto) :GetProductDto
    {
        $product = new Product();
        $product->setName($productDto->name);
        $product->setQty( $productDto->qty);
        $product->setPrice($productDto->price);
        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return new GetProductDto($product->getUuid(),$product->getName(),$product->getQty(),$product->getPrice(),
            $product->getIncome());
    }

    public function getProduct(string $uuid): GetProductDto
    {
        $product = $this->productRepository->getProduct(Uuid::fromString($uuid)->toBinary());
        if (!$product) {
            throw new NotFoundHttpException('Product not found.');
        }
        return new GetProductDto($product->getUuid(),$product->getName(),$product->getQty(),$product->getPrice(),
            $product->getIncome());
    }

    public function getProducts(): iterable
    {
        $result = [];
        $products = $this->productRepository->getProducts();
        foreach ($products as $product){
            $result[] = new GetProductDto($product->getUuid(),$product->getName(),$product->getQty(),$product->getPrice(),
                $product->getIncome());
        }
        return $result;
    }
}