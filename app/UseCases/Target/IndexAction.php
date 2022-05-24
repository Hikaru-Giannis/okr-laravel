<?php
declare(strict_types=1);

namespace App\UseCases\Target;

use App\Repositories\Target\TargetRepository;

class IndexAction
{
    public function __construct(private TargetRepository $targetRepository)
    {
    }

    public function __invoke(int $userId)
    {
        $targetList = $this->targetRepository->retrieveByUserId($userId);
        return $targetList;
    }
}
