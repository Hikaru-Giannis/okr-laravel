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
}
