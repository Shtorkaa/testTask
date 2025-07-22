<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="Test Api",
 *     version="1.0.0",
 *     description="pukeko",
 * )

 * @OA\Schema(
 *     schema="UserRegistration",
 *     required={"phone", "name", "address"},
 *     @OA\Property(property="phone", type="string", example="+5676547345"),
 *     @OA\Property(property="name", type="string", example="Alexey"),
 *     @OA\Property(property="address", type="string", example="Moscow")
 * )
 * * @OA\Schema(
 *     schema="UserOrder",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="product_id", type="integer", example=2),
 *     @OA\Property(property="product_name", type="string", example="test"),
 *     @OA\Property(property="price", type="number", nullable=true, example=null),
 *     @OA\Property(property="category", type="string", nullable=true, example=null)
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
