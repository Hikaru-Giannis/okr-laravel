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

        $targetList = new TargetListEntitity;
        foreach ($targets as $target) {
            $targetList->add($target->toEntity());
        }

        return $targetList->targetList();
    }
}
