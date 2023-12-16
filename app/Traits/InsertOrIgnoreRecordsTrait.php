<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait InsertOrIgnoreRecordsTrait
{
    public static function createOrIgnoreMany(array $data): void
    {
        if (
            !property_exists(static::class, 'table') ||
            empty((new static)->table) ||
            empty($data)
        )
            return;

        DB::table((new static)->table)->insertOrIgnore($data);
    }
}
