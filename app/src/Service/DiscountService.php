<?php

namespace App\Service;

use App\Entity\Discount;
use Doctrine\ORM\EntityManagerInterface;

class DiscountService
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function applyDiscounts(array $products): array
    {
        $discounts = $this->entityManager->getRepository(Discount::class)->findAll();
        $discountMap = $this->buildDiscountMap($discounts);

        foreach ($products as &$product) {
            $this->applyDiscountToProduct($product, $discountMap);
        }

        return $products;
    }

    private function buildDiscountMap(array $discounts): array
    {
        $discountMap = [];
        foreach ($discounts as $discount) {
            if ($discount->getCategory()) {
                $discountMap['category'][$discount->getCategory()] = $discount->getPercentage();
            }
            if ($discount->getSku()) {
                $discountMap['sku'][$discount->getSku()] = $discount->getPercentage();
            }
        }
        return $discountMap;
    }

    private function applyDiscountToProduct(array &$product, array $discountMap): void
    {
        $originalPrice = $product['price'];
        $finalPrice = $originalPrice;
        $discountPercentage = 0;

        if (isset($discountMap['sku'][$product['sku']])) {
            $skuDiscount = $discountMap['sku'][$product['sku']];
            $finalPrice = $originalPrice * (1 - $skuDiscount);
            $discountPercentage = $skuDiscount;
        } elseif (isset($discountMap['category'][$product['category']])) {
            $categoryDiscount = $discountMap['category'][$product['category']];
            $finalPrice = $originalPrice * (1 - $categoryDiscount);
            $discountPercentage = $categoryDiscount;
        }

        $product['price'] = [
            'original' => $originalPrice,
            'final' => (int) $finalPrice,
            'discount_percentage' => $discountPercentage > 0 ? ($discountPercentage * 100) . '%' : null,
            'currency' => 'EUR'
        ];
    }
}
