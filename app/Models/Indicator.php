<?php

namespace App\Models;

use App\Entities\Indicator\IndicatorEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;

    public function toEntity(): IndicatorEntity
    {
        return new IndicatorEntity(
            id: $this->id,
            target_id: $this->target_id,
            contents: $this->contents,
            score: $this->score
        );
    }

    public function target()
    {
        return $this->belongsTo(Target::class);
    }
}
