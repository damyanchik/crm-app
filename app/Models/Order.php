<?php

namespace App\Models;

use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory, SortableTrait;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function orderItem(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
