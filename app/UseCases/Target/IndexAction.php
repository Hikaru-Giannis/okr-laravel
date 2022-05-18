<?php
declare(strict_types=1);

namespace App\UseCases\Target;

use App\Repositories\Target\TargetRepository;

class IndexAction
{
    public function __construct(private TargetRepository $targetRepository)
    {
    }

    public function __invoke(int $user_id)
    {
        $targetList = $this->targetRepository->retrieveByUserId($user_id);
        return $targetList;
    }
}
