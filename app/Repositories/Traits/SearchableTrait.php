<?php

declare(strict_types=1);

namespace App\Repositories\Traits;

trait SearchableTrait
{
    public function searchAndSort(array $searchParams, ?callable $whereCallback = null): object
    {
        $query = $this->model::search($searchParams['search'])
            ->sortBy($searchParams['column'], $searchParams['order']);

        if (!empty($whereCallback)) {
            $query->where($whereCallback);
        }

        return $query->paginate($searchParams['display']);
    }

    public function searchWhereItems(string $searchTerm, array $columns): object
    {
        foreach ($columns as $column) {
            $this->model->orWhere($column, 'like', "%$searchTerm%");
        }

        return $this->model->get();
    }
}
