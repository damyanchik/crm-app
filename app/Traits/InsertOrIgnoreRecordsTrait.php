<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait InsertOrIgnoreRecordsTrait
{
    public static function createOrIgnoreMany(array $data): void
    {
        if (self::checkTableAndDataValidity($data)) {
            return;
        }

        DB::table((new static)->table)->insertOrIgnore($data);
    }

    private static function checkTableAndDataValidity(array $data): bool {
        return (
            !property_exists(static::class, 'table') ||
            empty((new static)->table) ||
            empty($data)
        );
    }
}
