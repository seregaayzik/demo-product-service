<?php

namespace App\Controller;

use App\Dto\DecreaseProductDto;
use App\Service\InventoryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class InventoryController extends AbstractController
{
    public function __construct(
        private readonly InventoryServiceInterface $inventoryService
    )
    {}
    #[Route('/inventory/{uuid}/decrease', name: 'decrease_inventory', methods: ['POST'])]
    public function decreaseQty(string $uuid,#[MapRequestPayload(
        acceptFormat: 'json',
        validationGroups: ['strict', 'read'],
        validationFailedStatusCode: Response::HTTP_BAD_REQUEST
    )]  DecreaseProductDto $decreaseProductDto): JsonResponse
    {
        $success = $this->inventoryService->decrease($uuid,$decreaseProductDto->qty);
        return $this->json([
            'success' => $success
        ]);
    }
}
