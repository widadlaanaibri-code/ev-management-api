<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable , InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'oauth_id',
        'establishment_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {

        return $this->roles->where('name', $role);
    }

    public function establishment(){
        return $this->belongsTo(Establishment::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'reservations', 'user_id', 'event_id')->withPivot('status')->withTimestamps();
    }


    public function event(){
        return $this->hasOne(Event::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function hasPendingReservation(Event $event)
    {
        return $this->events()->where('events.id', $event->id)->wherePivot('status', 'pending')->exists();
    }
}
