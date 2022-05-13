<?php
declare(strict_types=1);

namespace App\Http\Resources\Target;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $targets = [];
        foreach ($this->resource as $target) {
            $targets[] = [
                'id' => $target->id(),
                'user_id' => $target->user_id(),
                'contents' => $target->contents(),
                'status' => $target->status(),
                'total_score' => $target->total_score(),
                'expiration_date' => $target->expiration_date()
            ];
        };
        return [
            'status' => 200,
            'targets' => $targets
        ];
    }
}
