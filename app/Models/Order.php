<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'client_id',
        'status',
        'invoice_num',
        'total_quantity',
        'total_price'
    ];

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($query) use ($searchTerm) {
            $query->orWhere('id', 'like', '%' . $searchTerm . '%')
                ->orWhere('invoice_num', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('client', function ($clientQuery) use ($searchTerm) {
                    $clientQuery->where(function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('surname', 'like', '%' . $searchTerm . '%')
                            ->orWhere('company', 'like', '%' . $searchTerm . '%');
                    });
                })
                ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                    $userQuery->where(function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('surname', 'like', '%' . $searchTerm . '%');
                    });
                });
        });
    }

    public function scopeSortBy($query, $column, $direction)
    {
        return $query->orderBy($column, $direction);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
