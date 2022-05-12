<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Http\JsonResponse;
use App\UseCases\User\StoreAction;

class UserController extends Controller
{
    /**
     * @param StoreRequest $request
     * @param StoreAction $action
     * @return JsonResponse
     */
    public function create(StoreRequest $request, StoreAction $action): JsonResponse
    {
        $inputParams = $request->only(['name', 'email', 'password']);
        $action($inputParams['name'], $inputParams['email'], $inputParams['password']);
        return new JsonResponse([
            'status' => 200
        ]);
    }
}
