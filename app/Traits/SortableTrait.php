<?php

declare(strict_types=1);

namespace App\Traits;

trait SortableTrait
{
    public function scopeSortBy($query, $column, $direction)
    {
        if (empty($column)|| empty($direction)) {
            return $query->orderBy('id', 'ASC');
        }

        if ($this->isSortingInputValid($column, $direction)) {
            return $query->orderBy('id', 'ASC');
        }

        return $query->orderBy($column, $direction);
    }

    private function isSortingInputValid(string $column, string $direction): bool
    {
        $allowedColumns = array_merge(['id', 'created_at', 'updated_at'], $this->fillable);
        $allowedDirections = ['ASC', 'DESC'];

        return (
            !in_array(strtolower($column), $allowedColumns) ||
            !in_array(strtoupper($direction), $allowedDirections)
        );
    }
}
