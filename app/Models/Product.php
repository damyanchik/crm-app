<?php

namespace App\Models;

use App\Traits\SortableTrait;
use App\Traits\UpdateSelectedRecordsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, SortableTrait, UpdateSelectedRecordsTrait;

    protected $table = 'products';

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
        'code',
        'photo',
        'description'
    ];

    public function scopeSearch($query, $searchTerm)
    {
        return $query->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->where(function ($query) use ($searchTerm) {
                $query->orWhere('products.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('products.code', 'like', '%' . $searchTerm . '%')
                    ->orWhere('brands.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('product_categories.name', 'like', '%' . $searchTerm . '%');
            })
            ->select(
                'products.*',
                'product_categories.name as category',
                'brands.name as brand'
            );
    }

    public static function getExistingByCodes(array $data): array
    {
        if (isset($data[0]['code']) || isset($data['code'])) {
            $codes = array_column($data, 'code');
        } else {
            $codes = $data;
        }

        return Product::whereIn('code', $codes)
            ->select('code')
            ->get()
            ->toArray();
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
