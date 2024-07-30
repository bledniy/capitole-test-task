<?php

namespace App\Application\Factory;

use App\Application\Query\ProductQuery;

class ProductQueryFactory
{
    public function create(array $arguments): ProductQuery
    {
        return new ProductQuery(
            $arguments['category'] ?? null,
            $arguments['priceLessThan'] ?? null,
            $arguments['limit'] ?? 5
        );
    }
}
