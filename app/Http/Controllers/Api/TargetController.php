<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Target\EvaluateRequest;
use App\Http\Requests\Target\IndexRequest;
use App\Http\Requests\Target\RegisterRequest;
use App\Http\Requests\Target\ScoreRequest;
use App\Http\Requests\Target\ShowRequest;
use App\UseCases\Target\IndexAction;
use App\UseCases\Target\TargetShowAction;
use App\UseCases\Target\TargetStoreAction;
use App\UseCases\Indicator\IndicatorsStoreAction;
use App\UseCases\Indicator\ScoreAction;
use App\Http\Resources\Target\IndexResource;
use App\Http\Resources\Target\ShowResource;
use App\UseCases\Target\CompleteEvaluateAction;
use App\UseCases\Target\TotalScoreStoreAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
     * 目標詳細情報を取得
     *
     * @param ShowRequest $request
     * @param TargetShowAction $action
     * @return JsonResponse
     */
    public function show(ShowRequest $request, TargetShowAction $action)
    {
        $user = $request->user;
        $target = $action((int)$request->target_id);

        try {
            if ($user->id !== $target->user_id()) {
                throw new \Exception('ERROR: Not equals user_id.');
            }

            return new ShowResource($target);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return new JsonResponse([
                'status' => 400,
                'message' => 'ERROR: Bad request.'
            ]);
        }
    }

    /**
     * 目標情報を登録
     *
     * @param RegisterRequest $request
     * @param TargetStoreAction $targetAction
     * @param IndicatorsStoreAction $indicatorsAction
     * @return JsonResponse
     */
    public function register(
        RegisterRequest $request,
        TargetStoreAction $targetAction,
        IndicatorsStoreAction $indicatorsAction
    ): JsonResponse {
        // TODO 例外処理を考慮
        $user = $request->user;
        $targetId = $targetAction($user->id, $request->target['contents'], $request->target['expiration_date']);
        $indicatorsAction($targetId, $request->indicators);
        return new JsonResponse(['status' => 200]);
    }

    /**
     * 目標の採点処理
     *
     * @param ScoreRequest $request
     * @param ScoreAction $scoreAction
     * @param TotalScoreStoreAction $totalScoreAction
     * @return void
     */
    public function score(
        ScoreRequest $request,
        ScoreAction $scoreAction,
        TotalScoreStoreAction $totalScoreAction
    ): JsonResponse {

        DB::beginTransaction();
        try {
            $scoreAction($request->indicators);
            $totalScoreAction($request->target_id, $request->indicators);
            DB::commit();
            return new JsonResponse(['status' => 200]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            DB::rollBack();
            return new JsonResponse(['status' => 400], 400);
        }
    }

    /**
     * 評価完了処理
     *
     * @param EvaluateRequest $request
     * @param ScoreAction $scoreAction
     * @param CompleteEvaluateAction $completeEvaluateAction
     * @return JsonResponse
     */
    public function completeEvaluate(
        EvaluateRequest $request,
        ScoreAction $scoreAction,
        CompleteEvaluateAction $completeEvaluateAction
    ): JsonResponse {

        DB::beginTransaction();
        try {
            $scoreAction($request->indicators);
            $completeEvaluateAction($request->target_id, $request->indicators);
            DB::commit();
            return new JsonResponse(['status' => 200]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            DB::rollBack();
            return new JsonResponse(['status' => 400], 400);
        }
    }
}
