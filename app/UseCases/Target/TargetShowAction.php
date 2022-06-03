<?php
declare(strict_types=1);

namespace App\UseCases\Target;

use App\Repositories\Target\TargetRepository;

class TargetShowAction
{
    public function __construct(private TargetRepository $targetRepository)
    {
    }

    public function __invoke(int $targetId)
    {
        $target = $this->targetRepository->retrieveByTargetId($targetId);
        return $target;
    }
}
