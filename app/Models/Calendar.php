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
        'priority',
        'date_start',
        'date_end'
    ];
}
