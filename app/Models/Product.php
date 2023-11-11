<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'brand_id',
        'category_id',
        'quantity',
        'price',
        'unit',
        'status',
        'description'
    ];

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'like', '%' . $searchTerm . '%')
            ->orWhereHas('brand', function ($brandQuery) use ($searchTerm) {
                $brandQuery->where('name', 'like', "%$searchTerm%");
            });
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

}
