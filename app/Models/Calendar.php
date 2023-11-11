<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'Calendar';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'color',
        'date_start',
        'date_end'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
