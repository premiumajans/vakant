<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *    title="APIs For Thrift Store",
 *    version="1.0.0",
 * ),
 *   @OA\SecurityScheme(
 *       securityScheme="bearerAuth",
 *       in="header",
 *       name="bearerAuth",
 *       type="http",
 *       scheme="bearer",
 *       bearerFormat="JWT",
 *    ),
 */
/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0",
 *         title="Vakant Api List",
 *         description="Vakant List Api",
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
