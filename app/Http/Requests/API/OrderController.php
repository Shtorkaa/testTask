<?php

namespace App\Http\Requests\API;

use App\Http\Controllers\Controller;

use App\Http\Requests\GetUserOrdersRequest;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;
use App\Http\Resources\OrderCollection;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/orders",
     *     tags={"Orders"},
     *     summary="Get user orders",
     *     description="Returns list of orders for specific user",
     *     operationId="getUserOrders",
     *     
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="ID of the user",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
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
     *                     @OA\Property(property="product_id", type="integer", example=2),
     *                     @OA\Property(property="product_name", type="string", example="test"),
     *                     @OA\Property(property="price", type="number", nullable=true, example=null),
     *                     @OA\Property(property="category", type="string", nullable=true, example=null)
     *                 )
     *             )
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User not found")
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=400,
     *         description="Invalid user ID supplied",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Invalid user ID")
     *         )
     *     )
     * )
     */
    public function index(GetUserOrdersRequest $request)
    {
        $orders = Order::with('product')
            ->where('user_id', $request->user_id)
            ->get();

        return response()->json([
            new OrderCollection($orders)
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     *     path="/api/orders",
     *     tags={"Orders"},
     *     summary="Create new order",
     *     description="Create a new order for user",
     *     operationId="createOrder",
     *     
     *     @OA\RequestBody(
     *         required=true,
     *         description="Order data",
     *         @OA\JsonContent(
     *             required={"user_id", "product_id", "quantity"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="product_id", type="integer", example=2),
     *             @OA\Property(property="quantity", type="integer", minimum=1, example=2),
     *             @OA\Property(property="comment", type="string", example="test", nullable=true)
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=201,
     *         description="Order created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="order_id", type="integer", example=5),
     *             @OA\Property(property="price", type="number", format="float", example=9046),
     *             @OA\Property(property="status", type="string", example="success")
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The selected product id is invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="product_id",
     *                     type="array",
     *                     @OA\Items(type="string", example="The selected product id is invalid.")
     *                 )
     *             )
     *         )
     *     ),
     *     
     * )
     */
    public function store(StoreOrderRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        //Создание записи о заказе
        $order = Order::create($request->validated());

        //Расчет суммы 
        $sum = $product->price * $request->quantity;

        return response()->json([
            'order_id' => $order->id,
            'price' => $sum,
            'status' => "success",
        ], 201);

    }

}
