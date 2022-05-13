<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Entities\Target\TargetEntity;
use App\Entities\Target\TargetEnties;
use App\Entities\Target\TargetEntities;

class Target extends Model
{
    use HasFactory;

    public function toEntity(): TargetEntity
    {
        return new TargetEntity(
            id: $this->id,
            user_id: $this->user_id,
            contents: $this->contents,
            status: $this->status,
            total_score: $this->total_score,
            expiration_date: $this->expiration_date
        );
    }

    public function toEntities(): TargetEntities
    {
        return new TargetEntities();
    }
}
