<?php

namespace App\Http\Resources\Recretion;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecreationPackagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'rules' => $this->rules,
            'description' => $this->description,
        ];
    }
}
