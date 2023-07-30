<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OpeningResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title" => $this->title,
            "specializations" => $this->field,
            "status" => $this->is_open,
            "organization" => $this->organization,
            "created by" => User::collection($this->whenLoaded('organization'))
        ];
    }
}
