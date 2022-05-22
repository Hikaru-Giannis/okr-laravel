<?php
declare(strict_types=1);

namespace App\Repositories\Target;

use App\Entities\Target\TargetListEntitity;
use App\Models\Target;

class TargetRepository
{
    public function retrieveByUserId(int $user_id)
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
        $expirationDateTime = new \Datetime($expirationDate);
        $target = new Target;
        $target->user_id = $userId;
        $target->contents = $contents;
        $target->expiration_date = $expirationDateTime->format('Y-m-d 23:59:59');
        $target->save();
        return $target->id;
    }
}
