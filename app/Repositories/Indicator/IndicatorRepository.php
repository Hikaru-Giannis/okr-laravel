<?php
declare(strict_types=1);

namespace App\Repositories\Indicator;

use App\Models\Indicator;

class IndicatorRepository
{
    /**
     * 成果目標を登録
     *
     * @param integer $targetId
     * @param string $contents
     * @return int
     */
    public function save(int $targetId, string $contents): int
    {
        $indicator = new Indicator;
        $indicator->target_id = $targetId;
        $indicator->contents = $contents;
        $indicator->save();
        return $indicator->id;
    }

    /**
     * 成果目標を採点
     *
     * @param integer $indicatorId
     * @param float $score
     * @return void
     */
    public function score(int $indicatorId, float $score): void
    {
        $indicator = Indicator::find($indicatorId);
        $indicator->score = $score;
        $indicator->save();
    }
}
