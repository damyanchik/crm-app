<?php

namespace App\Models;

use App\Observers\OrderItemObserver;
use App\Traits\InsertOrIgnoreRecordsTrait;
use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
