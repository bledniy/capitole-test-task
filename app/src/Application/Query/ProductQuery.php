<?php

namespace App\Application\Query;

readonly class ProductQuery
{
    public function __construct(
        private ?string $category,
        private ?int $priceLessThan,
        private int $limit = 5
    ) {
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getPriceLessThan(): ?int
    {
        return $this->priceLessThan;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}

