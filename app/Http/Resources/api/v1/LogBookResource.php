<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'description' => $this->description,
            'endorsements' => EndorcementResource::collection($this->whenLoaded('endorsements'))->when($this->resource->is_endorsed, true),
            'student' => UserResource::collection($this->whenLoaded('student'))
        ];
    }
}
