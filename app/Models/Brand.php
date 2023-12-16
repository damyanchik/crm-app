<?php

namespace App\Models;

use App\Traits\InsertOrIgnoreRecordsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, InsertOrIgnoreRecordsTrait;

    protected $table = 'brands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
