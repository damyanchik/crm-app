<?php

namespace App\Models;

use App\Traits\InsertOrIgnoreRecordsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory, InsertOrIgnoreRecordsTrait;

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

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
