<?php
declare(strict_types=1);

namespace App\Http\Resources\Target;

use App\Consts\Target;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request):array
    {
        $targets = [];
        foreach ($this->resource as $target) {
            $indicators = [];
            foreach ($target->indicators() as $indicator) {
                $indicators[] = [
                    'id' => $indicator->id(),
                    'contents' => $indicator->contents(),
                    'score' => $indicator->score(),
                ];
            }
            $targets[] = [
                'id' => $target->id(),
                'user_id' => $target->user_id(),
                'contents' => $target->contents(),
                'status' => Target::STATUS_VALUE_LIST[$target->status()],
                'total_score' => $target->total_score(),
                'expiration_date' => $target->expiration_date(),
                'indicators' => $indicators,
            ];
        };
        return [
            'status' => 200,
            'targets' => $targets
        ];
    }
}
