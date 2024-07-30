<?php

namespace App\Service;

use App\Application\Query\ProductQuery;

class ProductService
{
    public function __construct(
        private readonly ProductQueryService $productQueryService,
        private readonly DiscountService $discountService,
    ) {
    }

    public function getProductsByQuery(ProductQuery $query): array
    {
        $products = $this->productQueryService->findProducts($query);

        return $this->discountService->applyDiscounts($products);
    }
}

