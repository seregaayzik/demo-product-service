<?php

namespace App\Controller;

use App\Dto\CreateProductDto;
use App\Service\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly ProductServiceInterface $productService
    ) {}
    #[Route('/product', name: 'create_product', methods: ['POST'])]
    public function createProduct(#[MapRequestPayload(
        acceptFormat: 'json',
        validationGroups: ['strict', 'read'],
        validationFailedStatusCode: Response::HTTP_BAD_REQUEST
    )]  CreateProductDto $productDto): JsonResponse
    {
        $product = $this->productService->postProduct($productDto);
        return $this->json([
            'data' => $product
        ]);
    }

    #[Route('/product', name: 'get_products', methods: ['GET'])]
    public function getProducts(): JsonResponse
    {
        $products = $this->productService->getProducts();
        return $this->json([
            'data' => $products
        ]);
    }

    #[Route('/product/{uuid}', name: 'get_product', methods: ['GET'])]
    public function getProduct(string $uuid): JsonResponse
    {
        $products = $this->productService->getProduct($uuid);
        return $this->json([
            'data' => $products
        ]);
    }
}
