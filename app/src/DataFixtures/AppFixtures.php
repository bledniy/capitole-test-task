<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Discount;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $products = [
            ['sku' => '000001', 'name' => 'BV Lean leather ankle boots', 'category' => 'boots', 'price' => 89000],
            ['sku' => '000002', 'name' => 'BV Lean leather ankle boots', 'category' => 'boots', 'price' => 99000],
            ['sku' => '000003', 'name' => 'Ashlington leather ankle boots', 'category' => 'boots', 'price' => 71000],
            ['sku' => '000004', 'name' => 'Naima embellished suede sandals', 'category' => 'sandals', 'price' => 79500],
            ['sku' => '000005', 'name' => 'Nathane leather sneakers', 'category' => 'sneakers', 'price' => 59000]
        ];

        foreach ($products as $p) {
            $product = new Product();

            $product->setSku($p['sku']);
            $product->setName($p['name']);
            $product->setCategory($p['category']);
            $product->setPrice($p['price']);
            $manager->persist($product);
        }

        $discounts = [
            ['category' => 'boots', 'percentage' => 0.30],
            ['sku' => '000003', 'percentage' => 0.15]
        ];

        foreach ($discounts as $d) {
            $discount = new Discount();

            $discount->setCategory($d['category'] ?? null);
            $discount->setSku($d['sku'] ?? null);
            $discount->setPercentage($d['percentage']);
            $manager->persist($discount);
        }

        $manager->flush();
    }
}
