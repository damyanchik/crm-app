<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
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

    protected function checkModelOrInt(Model|int $model): Model|int
    {
        return is_int($model) ? $this->findById($model) : $model;
    }
}
