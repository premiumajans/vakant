<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Create Vakant
 * @OA\Get  (
 *     path="/api/",
 *     tags={"Vakant"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                      type="object",
 *                      @OA\Property(
 *                          property="title",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="content",
 *                          type="string"
 *                      )
 *                 ),
 *                 example={
 *                     "title":"example title",
 *                     "content":"example content"
 *                }
 *             )
 *         )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="number", example=1),
 *              @OA\Property(property="title", type="string", example="title"),
 *              @OA\Property(property="content", type="string", example="content"),
 *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
 *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="invalid",
 *          @OA\JsonContent(
 *              @OA\Property(property="msg", type="string", example="fail"),
 *          )
 *      )
 * )
 */
class DocumentationController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'name' => $request->input('name'),
            'message' => 'Hello World!'
        ]);
    }
}
