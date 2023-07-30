<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'matric_no' => $this->matric_no,
            'email' => $this->email,
            'role' => $this->user_role,
            'endorsements' => EndorcementResource::collection($this->whenLoaded('endorsements')),
            'applications' => ApplicationResource::collection($this->whenLoaded('applications')),
            'openings' => OpeningResource::collection($this->whenLoaded('openings')),
            'logBooks' => LogBookResource::collection($this->whenLoaded('logBook'))
        ];
    }
}
