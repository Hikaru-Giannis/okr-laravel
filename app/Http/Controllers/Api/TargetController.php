<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Target\IndexRequest;
use App\Http\Requests\Target\RegisterRequest;
use App\UseCases\Target\IndexAction;
use App\UseCases\Target\StoreAction;
use App\Http\Resources\Target\IndexResource;
use Illuminate\Http\JsonResponse;

class TargetController extends Controller
{
    /**
     * 目標一覧情報を取得
     *
     * @param IndexRequest $request
     * @param IndexAction $action
     * @return IndexResource
     */
    public function index(IndexRequest $request, IndexAction $action): IndexResource
    {
        $user = $request->user;
        $targetList = $action($user->id);
        return new IndexResource($targetList->getValue());
    }

    public function register(RegisterRequest $request, StoreAction $action)
    {
        $user = $request->user;
        $targetId = $action($user->id, $request->target['contents'], $request->target['expiration_date']);
        return new JsonResponse(['status' => 200, 'target' => $request->target]);
    }
}
