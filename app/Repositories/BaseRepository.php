<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public function __construct(protected Model $model)
    {
    }

    public function findById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function getAll(): ?object
    {
        return $this->model->all();
    }

    public function store(array $data): void
    {
        $this->model->create($data);
    }

    public function update(Model|int $model, array $data): void
    {
        $currentModel = $this->checkModelOrInt($model);
        $currentModel->update($data);
    }

    public function destroy(Model|int $model): void
    {
        $currentModel = $this->checkModelOrInt($model);
        $currentModel->delete();
    }

    public function getByColumn(string $value, string $column = 'id'): ?Model
    {
        return $this->query()->where($column, $value)->first();
    }

    private function query(): object
    {
        return call_user_func([$this->model, 'query']);
    }

    protected function checkModelOrInt(Model|int $model): Model|int
    {
        return is_int($model) ? $this->findById($model) : $model;
    }
}
