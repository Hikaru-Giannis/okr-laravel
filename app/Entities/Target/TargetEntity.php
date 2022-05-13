<?php
declare(strict_types=1);

namespace App\Entities\Target;

class TargetEntity
{
    public function __construct(
        private int $id,
        private int $user_id,
        private string $contents,
        private int $status,
        private float $total_score,
        private string | null $expiration_date
    )
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function user_id(): int
    {
        return $this->user_id;
    }

    public function contents(): string
    {
        return $this->contents;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function total_score(): float
    {
        return $this->total_score;
    }

    public function expiration_date(): ?string
    {
        return $this->expiration_date;
    }

}
