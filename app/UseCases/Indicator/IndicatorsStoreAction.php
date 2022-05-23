<?php
declare(strict_types=1);

namespace App\UseCases\Indicator;

use App\Repositories\Indicator\IndicatorRepository;

class IndicatorsStoreAction
{
    public function __construct(private IndicatorRepository $indicatorRepository)
    {
    }

    public function __invoke(int $targetId, array $indicators) :void
    {
        foreach ($indicators as $contents) {
            $this->indicatorRepository->save(
                targetId: $targetId,
                contents: $contents
            );
        }
    }
}
