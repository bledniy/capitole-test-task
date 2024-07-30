<?php

namespace App\Application\Dto;

class ProductRequest
{
    public function __construct(
        private readonly mixed $category,
        private readonly mixed $priceLessThan,
        private readonly mixed $limit,
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
