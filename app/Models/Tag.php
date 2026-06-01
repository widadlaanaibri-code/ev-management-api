<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    /**
     * The events that belong to the tag.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_tag');
    }
}
