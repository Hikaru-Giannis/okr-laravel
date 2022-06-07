<?php
declare(strict_types=1);

namespace App\Repositories\Target;

use App\Entities\Target\TargetEntity;
use App\Entities\Target\TargetListEntitity;
use App\Models\Target;
use App\Consts\Target as ConstsTarget;

class TargetRepository
{
    /**
     * 目標IDから取得
     *
     * @param integer $targetId
     * @return TargetEntity
     */
    public function retrieveByTargetId(int $targetId): TargetEntity
    {
        $target = Target::find($targetId);
        $indicators = $target->indicators;
        $indicatorListEntity = $indicators->map(function ($indicator) {
            return $indicator->toEntity();
        });
        $targetEntity = $target->toEntity();
        $targetEntity->setIndicators($indicatorListEntity->toArray());

        return $targetEntity;
    }

    /**
     * ユーザーIDから取得
     *
     * @param integer $user_id
     * @return TargetListEntitity
     */
    public function retrieveByUserId(int $user_id): TargetListEntitity
    {
        $targets = Target::query()
            ->where('user_id', $user_id)
            ->with('indicators')
            ->get();

        $targetListEntity = $targets->map(function ($target) {
            $indicators = $target->indicators;
            $indicatorListEntity = $indicators->map(function ($indicator) {
                return $indicator->toEntity();
            });
            $targetEntity = $target->toEntity();
            $targetEntity->setIndicators($indicatorListEntity->toArray());
            return $targetEntity;
        });

        return new TargetListEntitity($targetListEntity->toArray());
    }

    /**
     * 目標登録
     *
     * @param integer $userId
     * @param string $contents
     * @param string $expirationDate
     * @return int
     */
    public function save(int $userId, string $contents, string $expirationDate): int
    {
        $target = new Target;
        $target->user_id = $userId;
        $target->contents = $contents;
        $target->expiration_date = $expirationDate;
        $target->save();
        return $target->id;
    }

    /**
     * 合計スコアを保存
     *
     * @param integer $targetId
     * @param float $totalScore
     * @return void
     */
    public function saveTotalScore(int $targetId, float $totalScore): void
    {
        $target = Target::find($targetId);
        $target->total_score = $totalScore;
        $target->save();
    }

    /**
     * 評価を完了
     *
     * @param integer $targetId
     * @param float $totalScore
     * @return void
     */
    public function completeEvaluate(int $targetId, float $totalScore): void
    {
        $target = Target::find($targetId);
        $target->total_score = $totalScore;
        $target->status = ConstsTarget::STATUS_COMPLETION;
        $target->save();
    }
}
