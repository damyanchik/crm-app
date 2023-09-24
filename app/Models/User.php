<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'position',
        'department'
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

//    public function scopeFilter($query, array $filters)
//    {
//        if ($filters['search'] ?? false)
//            $query->where('name', 'like', '%' . request('search') . '%')
//                ->orWhere('surname', 'like', '%' . request('search') . '%')
//                ->orWhere('email', 'like', '%' . request('search') . '%')
//                ->orWhere('phone', 'like', '%' . request('search') . '%')
//                ->orWhere('address', 'like', '%' . request('search') . '%')
//                ->orWhere('postal_code', 'like', '%' . request('search') . '%')
//                ->orWhere('city', 'like', '%' . request('search') . '%')
//                ->orWhere('state', 'like', '%' . request('search') . '%')
//                ->orWhere('country', 'like', '%' . request('search') . '%')
//                ->orWhere('position', 'like', '%' . request('search') . '%')
//                ->orWhere('department', 'like', '%' . request('search') . '%');
//    }
}
