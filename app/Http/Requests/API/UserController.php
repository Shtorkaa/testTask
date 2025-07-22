<?php

namespace App\Http\Requests\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *     path="/register",
     *     tags={"Users"},
     *     summary="Register a new user",
     *     description="Creates a new user account with phone, name and address",
     *     operationId="registerUser",
     *     
     *     @OA\RequestBody(
     *         required=true,
     *         description="User data",
     *         @OA\JsonContent(ref="#/components/schemas/UserRegistration")
     *     ),
     *     
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User registered successfully")
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "phone": {"The phone field is required."}
     *                 }
     *             )
     *         )
     *     )
     * )
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        User::create($data);

        return response()->json([
            'message' => 'User registered successfully',
        ], 201);
    }

    /**
     * Check if user exist and authenticate
     */
    /**
     * @OA\Post(
     *     path="/login",
     *     tags={"Authentication"},
     *     summary="User login",
     *     description="Authenticate user by phone number",
     *     operationId="loginUser",
     *     
     *     @OA\RequestBody(
     *         required=true,
     *         description="Phone number",
     *         @OA\JsonContent(
     *             required={"phone"},
     *             @OA\Property(property="phone", type="string", example="+5676547345")
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Loged in")
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="phone",
     *                 type="string",
     *                 example="Account not found"
     *             )
     *         )
     *     )
     * )
     */
    public function login(UserLoginRequest $request)
    {
        $user = User::where('phone', $request->validated())->first();

        if (!$user) {
            return response()->json([
                'phone' => 'Account not found',
            ], 404);
        }

        return response()->json([
            'message' => "Loged in",
        ], 200);
    }
}
