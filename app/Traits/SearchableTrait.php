<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait SearchableTrait
{
    public function searchAndSort(Model $model, array $searchParams, ?callable $whereCallback = null): object
    {
        $query = $model::search($searchParams['search'])
            ->sortBy($searchParams['column'], $searchParams['order']);

        if (!empty($whereCallback)) {
            $query->where($whereCallback);
        }

        return $query->paginate($searchParams['display']);
    }

    public function searchWhereItems(object $query, string $searchTerm, array $columns): object
    {
        foreach ($columns as $column) {
            $query->orWhere($column, 'like', "%$searchTerm%");
        }

        return $query->get();
    }
}
