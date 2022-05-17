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
            ->get();

        $targetListEntity = $targets->map(function ($target) {
            return $target->toEntity();
        });

        return new TargetListEntitity($targetListEntity->toArray());
    }
}
