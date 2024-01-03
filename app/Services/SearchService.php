<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\IndexRequest;
use Illuminate\Database\Eloquent\Model;

class SearchService
{
    public function searchItems(Model $model, IndexRequest $indexRequest, ?callable $whereCallback = null): object
    {
        $params = $indexRequest->getSearchParams();

        $query = $model::search($params['search'])
            ->sortBy($params['column'], $params['order']);

        if ($whereCallback !== null)
            $query->where($whereCallback);

        return $query->paginate($params['display']);
    }
}
