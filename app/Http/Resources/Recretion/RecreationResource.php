<?php

namespace App\Http\Resources\Recretion;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecreationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->image->toArray());
        return [
            'id' => $this->id,
            'name' => $this->business_name,
            'image' => $this->image ? asset('storage/' . $this->image->image) : asset('images/not_found.jpg'),
            'location' => $this->kota ? $this->kota['city_name'] : 'Kota dihapus',
            'unit_price' => $this->recreationPackages->first()->unit_price ?? null,
            'price' => $this->recreationPackages->first()->price ?? null,
            'rating_count' => $this->reviews_count,
            'avg_rating' => $this->avgRating(),
        ];
    }
}
