<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpectatorResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone ?? 'N/A',
            'registeredDate' => $this->created_at->format('Y-m-d'),
            'ticketsPurchased' => 0,
            'status' => $this->status ?? 'active',
        ];
    }
}
