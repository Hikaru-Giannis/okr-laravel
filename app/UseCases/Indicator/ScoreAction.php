<?php
declare(strict_types=1);

namespace App\UseCases\Indicator;

use App\Repositories\Indicator\IndicatorRepository;

class ScoreAction
{
    public function __construct(private IndicatorRepository $indicatorRepository)
    {
    }

    public function __invoke(array $indicators): void
    {
        foreach ($indicators as $indicator) {
            $this->indicatorRepository->score($indicator['indicator_id'], $indicator['score']);
        }
    }
}
