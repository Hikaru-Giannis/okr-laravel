<?php

namespace App\Http\Resources\Target;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $indicators = [];
        foreach ($this->resource->indicators() as $indicator) {
            $indicators[] = [
                'id' => $indicator->id(),
                'contents' => $indicator->contents(),
                'score' => $indicator->score(),
            ];
        }
        $target = [
            'id' => $this->resource->id(),
            'user_id' => $this->resource->user_id(),
            'contents' => $this->resource->contents(),
            'status' => $this->resource->status(),
            'total_score' => $this->resource->total_score(),
            'expiration_date' => $this->resource->expiration_date(),
            'indicators' => $indicators,
        ];

        return [
            'status' => 200,
            'target' => $target
        ];
    }
}
