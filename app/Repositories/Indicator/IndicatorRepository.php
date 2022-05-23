<?php
declare(strict_types=1);

namespace App\Repositories\Indicator;

use App\Models\Indicator;

class IndicatorRepository
{
    /**
     * 成果目標登録
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
}
