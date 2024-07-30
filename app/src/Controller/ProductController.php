<?php

namespace App\Controller;

use App\Application\Factory\{ProductQueryFactory, ProductRequestFactory};
use App\Common\Application\Service\Validator\ValidatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ProductService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

class ProductController extends AbstractController
{
    #[Route('/api/products', name: 'api_products', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Retrieve filtered list of products",
     *     description="Returns a list of products, optionally filtered by category and price threshold. Discounts are applied as per the business rules.",
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         required=false,
     *         description="Filter by product category",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="priceLessThan",
     *         in="query",
     *         required=false,
     *         description="Filter products to those with a price less than the specified value",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="products",
     *                 type="array",
     *                 @OA\Items(ref=@Model(type=App\Entity\Product::class))
     *             )
     *         )
     *     )
     * )
     */
    public function getProducts(
        Request $request,
        ProductService $productService,
        ProductRequestFactory $productRequestFactory,
        ProductQueryFactory $productQueryFactory,
        ValidatorService $validator,
    ): JsonResponse {
        $request = $request->query->all();
        $productRequest = $productRequestFactory->create($request);

        $validator->validate($productRequest);

        $query = $productQueryFactory->create($request);

        return $this->json(['products' => $productService->getProductsByQuery($query)]);
    }
}
