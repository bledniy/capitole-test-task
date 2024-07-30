<?php

namespace App\Tests;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductFilterTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testProductFilters($url, $expectedCount, $expectedStatus = 200)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $response = $client->getResponse();
        $this->assertSame($expectedStatus, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);
        $this->assertCount($expectedCount, $data['products']);
    }

    public function urlProvider(): Generator
    {
        yield ['/api/products?category=boots', 2];
        yield ['/api/products?category=sandals', 1];
        yield ['/api/products?priceLessThan=80000', 3];
        yield ['/api/products?category=boots&priceLessThan=100000', 2];
        yield ['/api/products?category=nonexistent', 0, 404];
        yield ['/api/products?priceLessThan=0', 0];
        yield ['/api/products?priceLessThan=abc', 0, 400]; // Assuming your API handles this as a bad request
    }
}

