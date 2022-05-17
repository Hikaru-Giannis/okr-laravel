<?php
declare(strict_types=1);

namespace App\Entities\Indicator;

class IndicatorEntity
{
    public function __construct(
        private int $id,
        private int $target_id,
        private string $contents,
        private float $score
    )
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function target_id(): int
    {
        return $this->target_id;
    }

    public function contents(): string
    {
        return $this->contents;
    }

    public function score(): float
    {
        return $this->score;
    }

}
