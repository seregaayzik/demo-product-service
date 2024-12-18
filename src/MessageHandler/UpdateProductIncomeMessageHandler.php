<?php

namespace App\MessageHandler;

use App\Message\UpdateProductIncomeMessage;
use App\Service\ProductServiceInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class UpdateProductIncomeMessageHandler
{
    public function __construct(
        private readonly ProductServiceInterface $productService
    )
    {}
    public function __invoke(UpdateProductIncomeMessage $message): void
    {
        $this->productService->increaseIncome($message->getUUid(),$message->getIncome());
    }
}
