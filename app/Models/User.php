<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'address',
        'postal_code',
        'city',
        'state',
        'country',
        'password',
        'avatar',
        'position',
        'department',
        'last_activity'
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

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($query) use ($searchTerm) {
            $query->orWhere('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('surname', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                ->orWhere('address', 'like', '%' . $searchTerm . '%')
                ->orWhere('postal_code', 'like', '%' . $searchTerm . '%')
                ->orWhere('city', 'like', '%' . $searchTerm . '%')
                ->orWhere('state', 'like', '%' . $searchTerm . '%')
                ->orWhere('country', 'like', '%' . $searchTerm . '%')
                ->orWhere('position', 'like', '%' . $searchTerm . '%')
                ->orWhere('department', 'like', '%' . $searchTerm . '%');
        });
    }

    public function scopeSortBy($query, $column, $direction)
    {
        return $query->orderBy($column, $direction);
    }

    public function client()
    {
        return $this->hasMany(Client::class, 'user_id');
    }

    public function chatMessage()
    {
        return $this->hasMany(ChatMessage::class, 'user_id');
    }

    public function calendar()
    {
        return $this->hasMany(Calendar::class, 'user_id');
    }
}
