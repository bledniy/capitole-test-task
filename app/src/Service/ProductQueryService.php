<?php

namespace App\Service;

use App\Application\Query\ProductQuery;
use App\Repository\ProductRepository;

class ProductQueryService
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function findProducts(ProductQuery $query): array
    {
        return $this->productRepository->findProductsByQuery($query);
    }
}
