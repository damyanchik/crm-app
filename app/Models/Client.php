<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'Client';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company',
        'name',
        'surname',
        'email',
        'phone',
        'address',
        'postal_code',
        'city',
        'state',
        'country',
        'tax',
        'user_id'
    ];

    public function scopeSearch($query, $searchTerm)
    {
        return $query->leftJoin('users', 'client.user_id', '=', 'users.id')
            ->where(function ($query) use ($searchTerm) {
                $query->orWhere('client.company', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.surname', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.email', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.phone', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.address', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.postal_code', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.city', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.state', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.country', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.tax', 'like', '%' . $searchTerm . '%')
                    ->orWhere('users.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('users.surname', 'like', '%' . $searchTerm . '%');
            })
            ->select(
                'client.*',
                'users.name',
                'users.surname'
            );
    }
    public function scopeSortBy($query, $column, $direction)
    {
        return $query->orderBy($column, $direction);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'client_id');
    }

}
