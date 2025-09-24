<?php

namespace App\Http\Resources\Recretion;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecreationDetailResource extends JsonResource
{
    public $images;
    public function __construct($resource, $images)
    {
        parent::__construct($resource);
        $this->images = $images;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "recreation_id" => $this->id,
            "service" => "recreation",
            "category" => $this->category->name,
            "user" => $this->user->name,
            "name" => $this->business_name,
            "description" => $this->description,
            "buka" => $this->open,
            "tutup" => $this->close,
            "city" => $this->kota->city_name ?? 'Kota tidak ditemukan',
            "address" => $this->address,
            "latitude" => $this->lat,
            "longitude" => $this->ltd,
            "avg_rating" => $this->avgRating(),
            "rating_count" => $this->reviews->count(),
            "images" => $this->images,
            "packages" => RecreationPackagesResource::collection($this->recreationPackages),
        ];
    }
}
