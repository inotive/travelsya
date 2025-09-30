<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'no_inv' => $this->no_inv,
            'service' => $this->service,
            'payment_method' => $this->payment_method,
            'payment_channel' => $this->payment_channel,
        ];
    }
}
