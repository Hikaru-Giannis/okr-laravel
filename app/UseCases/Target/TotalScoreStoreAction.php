<?php
declare(strict_types=1);

namespace App\UseCases\Target;

use App\Repositories\Target\TargetRepository;

class TotalScoreStoreAction
{
    public function __construct(private TargetRepository $targetRepository)
    {
    }

    public function __invoke(int $targetId, array $indicators)
    {
        $indicatorsScoreList = array_column($indicators, 'score');
        $totalScore = array_sum($indicatorsScoreList);

        return $this->targetRepository->saveTotalScore(
            targetId: $targetId,
            totalScore: $totalScore
        );
    }
}
