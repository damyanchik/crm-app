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
        return $query->leftJoin('client', 'orders.client_id', '=', 'client.id')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->where(function ($query) use ($searchTerm) {
                $query->orWhere('orders.id', 'like', '%' . $searchTerm . '%')
                    ->orWhere('orders.invoice_num', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.surname', 'like', '%' . $searchTerm . '%')
                    ->orWhere('client.company', 'like', '%' . $searchTerm . '%')
                    ->orWhere('users.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('users.surname', 'like', '%' . $searchTerm . '%');
            })
            ->select(
                'orders.*',
                'client.name',
                'client.surname',
                'client.company',
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

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
