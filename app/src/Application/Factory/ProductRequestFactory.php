<?php

namespace App\Application\Factory;

use App\Application\Dto\ProductRequest;

class ProductRequestFactory
{
    public function create(array $arguments): ProductRequest
    {
        return new ProductRequest(
            $arguments['category'] ?? null,
            $arguments['priceLessThan'] ?? null,
            $arguments['limit'] ?? null,
        );
    }
}
