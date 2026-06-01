<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;




    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'total_seats',
        'reserved_seats',
        'price',
        'createdBy',
        'category_id',
        'event_status',
        'automatic_accept'

    ];


    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function users(){
        return $this->belongsToMany(User::class , 'reservations','event_id', 'user_id')->withPivot('status')->withTimestamps();
    }

    public function creater(){
        return $this->belongsTo(User::class, 'createdBy');
    }

     /**
     * Check if the authenticated user has already reserved a ticket for this event.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function isReservedByUser(User $user)
    {
        return $this->reservations()->where('user_id', $user->id)->exists();
    }

    /**
     * Define a relationship between Event and Reservation model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * The tags that belong to the event.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'event_tag');
    }

    /**
     * Get the event image as an absolute URL, or null if no image.
     */
    public function image_url(): ?string
    {
        $path = $this->getFirstMediaUrl('event-images')
            ?: $this->getFirstMediaUrl('events')
            ?: $this->getFirstMediaUrl('media/events');

        return $path ? url($path) : null;
    }
}
