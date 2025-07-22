<?php

namespace App\Http\Requests\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/products",
     *     tags={"Products"},
     *     summary="Get all products",
     *     description="Returns list of all available products",
     *     operationId="getProductsList",
     *     
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Phone"),
     *                     @OA\Property(property="description", type="string", example="Phones"),
     *                     @OA\Property(property="price", type="number", format="float", example=2999),
     *                     @OA\Property(property="category", type="string", example="smartphone"),
     *                     @OA\Property(property="available", type="boolean", example=true)
     *                 )
     *             )
     *         )
     *     ),
     *    
     * )
     */
    public function show()
    {

        // $testProducts = [
        //     [
        //         'name' => 'Phone',
        //         'description' => 'Phiphone',
        //         'price' => 1000,
        //         'category' => 'smartphone',
        //         'available' => true,
        //     ],
        //     [
        //         'name' => 'test',
        //         'description' => '123',
        //         'price' => 4523,
        //         'category' => 'asdawd',
        //         'available' => false,
        //     ],
        //     [
        //         'name' => 'Pou',
        //         'description' => 'Plush',
        //         'price' => 9999,
        //         'category' => 'Plush',
        //         'available' => true,
        //     ],
        // ];

        // foreach ($testProducts as $productData) {
        //     Product::create($productData);
        // }

        $products = Product::all();

        return new ProductCollection($products);
    }
}
