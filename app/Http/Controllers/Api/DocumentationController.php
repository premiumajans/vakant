<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 *
 * @OA\POST  (
 *     path="/api/login",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                      type="object",
 *                      @OA\Property(
 *                          property="email",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="password",
 *                          type="string"
 *                      )
 *                 ),
 *                 example={
 *                     "email":"example@gmail.com",
 *                     "password":"Password"
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
 *
 *
 * Logout
 * @OA\POST  (
 *     path="/api/logout",
 *     tags={"Auth"},
 *      @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                      type="object",
 *                      @OA\Property(
 *                          property="token",
 *                          type="string"
 *                      ),
 *                 ),
 *                 example={
 *                     "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vdmFrYW50LnRlc3QvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2ODE3MTIyMjQsImV4cCI6MTY4MTcxNTgyNCwibmJmIjoxNjgxNzEyMjI0LCJqdGkiOiJwWjExckJxTUl1bnNBak5jIiwic3ViIjoiMSIsInBydiI6ImRmODgzZGI5N2JkMDVlZjhmZjg1MDgyZDY4NmM0NWU4MzJlNTkzYTkifQ.H4gd3Iez5hJKCV_GExHFFFPo08ga8WtqFhm0mHaAL-s",
 *                }
 *             )
 *         )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="number", example="success"),
 *              @OA\Property(property="message", type="string", example="successfully-logged-out"),
 *          )
 *      ),
 * )
 *
 *
 * Refresh
 * @OA\POST  (
 *     path="/api/refresh",
 *     tags={"Auth"},
 *      @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                      type="object",
 *                      @OA\Property(
 *                          property="token",
 *                          type="string"
 *                      ),
 *                 ),
 *                 example={
 *                     "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vdmFrYW50LnRlc3QvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2ODE3MTIyMjQsImV4cCI6MTY4MTcxNTgyNCwibmJmIjoxNjgxNzEyMjI0LCJqdGkiOiJwWjExckJxTUl1bnNBak5jIiwic3ViIjoiMSIsInBydiI6ImRmODgzZGI5N2JkMDVlZjhmZjg1MDgyZDY4NmM0NWU4MzJlNTkzYTkifQ.H4gd3Iez5hJKCV_GExHFFFPo08ga8WtqFhm0mHaAL-s",
 *                }
 *             )
 *         )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="success",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="number", example="success"),
 *              @OA\Property(
 *              property="authorisation",
 *               type="array",
 *               description="The survey ID",
 *               @OA\Items(
 *                  property="firstName",
 *                  type="string",
 *                  example=""
 *               ),
 *           ),
 *          )
 *      ),
 * )
 *
 */


class DocumentationController extends Controller
{
}
