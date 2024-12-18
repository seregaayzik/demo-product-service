<?php

namespace App\Service;

use App\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Uid\Uuid;

class InventoryService implements InventoryServiceInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly EntityManagerInterface $entityManager
    )
    { }
    public function decrease(string $uuid, int $qty): bool
    {
        $product = $this->productRepository->getProduct(Uuid::fromString($uuid)->toBinary());
        if (!$product || $product->getQty() < $qty) {
            throw new NotFoundHttpException('Product not found.');
        }
        $newQty = $product->getQty() - $qty;
        $product->setQty($newQty);
        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return true;
    }
}