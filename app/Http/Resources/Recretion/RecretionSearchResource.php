<?php

namespace App\Http\Resources\Recretion;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecretionSearchResource extends JsonResource
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
            'name' => $this->business_name,
            'image' => $this->image ? asset('storage/' . $this->image['image']) : asset('images/not_found.jpg'),
            'location' => $this->kota['city_name'] ?? 'Kota dihapus',
            'price' => $this->recreationPackages[0]['price'],
            'rating_count' => count($this->reviews),
            'avg_rating' => $this->avgRating(),
        ];
    }
}
