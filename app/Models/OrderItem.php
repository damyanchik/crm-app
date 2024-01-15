<?php

namespace App\Models;

use App\Observers\OrderItemObserver;
use App\Traits\InsertOrIgnoreRecordsTrait;
use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory, SortableTrait, InsertOrIgnoreRecordsTrait;

    protected $table = 'orders_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'name',
        'code',
        'unit',
        'quantity',
        'price',
        'product_price'
    ];

    protected $dispatchesEvents = [
        'inserted' => OrderItemObserver::class,
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
