<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *  title="L5 OpenApi",
 *  description="L5 Swagger OpenApi description",
 *  version="1.0.0"
 * )
 *
 * @OA\Server(
 *   description="OpenApi host",
 *   url="http://localhost"
 * )
 */
class TestController extends BaseController
{
}
