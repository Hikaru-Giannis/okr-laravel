<?php
declare(strict_types=1);

namespace App\Entities\Target;

class IndicatorListEntity
{
    private array $indicatorList;
    public function __construct(array $indicatorList)
    {
        $this->indicatorList = $indicatorList;
    }

    public function getValue(): array
    {
        return $this->indicatorList;
    }
}
