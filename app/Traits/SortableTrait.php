<?php

declare(strict_types=1);

namespace App\Traits;

trait SortableTrait
{
    public function scopeSortBy($query, $column, $direction)
    {
        if ($column == null || $direction == null)
            return $query->orderBy('id', 'ASC');

        $allowedColumns = array_merge(['id', 'created_at', 'updated_at'], $this->fillable);
        $allowedDirections = ['ASC', 'DESC'];

        if (
            !in_array(strtolower($column), $allowedColumns) ||
            !in_array(strtoupper($direction), $allowedDirections)
        )
            return $query->orderBy('id', 'ASC');

        return $query->orderBy($column, $direction);
    }
}
