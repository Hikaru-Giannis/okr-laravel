<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Target\IndexRequest;
use App\Http\Requests\Target\RegisterRequest;
use App\UseCases\Target\IndexAction;
use App\UseCases\Target\TargetStoreAction;
use App\UseCases\Indicator\IndicatorsStoreAction;
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

    /**
     * 目標情報を登録
     *
     * @param RegisterRequest $request
     * @param TargetStoreAction $targetAction
     * @param IndicatorsStoreAction $indicatorsAction
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, TargetStoreAction $targetAction, IndicatorsStoreAction $indicatorsAction): JsonResponse
    {
        $user = $request->user;
        $targetId = $targetAction($user->id, $request->target['contents'], $request->target['expiration_date']);
        $indicatorsAction($targetId, $request->indicators);
        return new JsonResponse(['status' => 200]);
    }
}
