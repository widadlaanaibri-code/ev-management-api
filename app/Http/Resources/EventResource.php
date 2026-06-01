<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'location' => $this->location,
            'total_seats' => $this->total_seats,
            'reserved_seats' => $this->reserved_seats,
            'available_seats' => $this->total_seats - $this->reserved_seats,
            'price' => $this->price,
            'event_status' => $this->event_status,
            'automatic_accept' => $this->automatic_accept,
            'image' => $this->image_url(),
            'category' => [
                'id' => $this->category->id ?? null,
                'name' => $this->category->name ?? null,
            ],
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'organizer' => [
                'id' => $this->creater->id ?? null,
                'name' => $this->creater->name ?? null,
                'email' => $this->creater->email ?? null,
                'phone' => $this->creater->phone ?? null,
            ],
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
