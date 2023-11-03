<?php

namespace Domain\Repositories;

use Data\Entities\TodoEntity as TodoEntity;
use Illuminate\Support\Collection;
use Infrastructure\EloquentModels\Todo as TodoModel;

interface TodoRepositoryInterface extends RepositoryInterface
{
    public function toEntity(TodoModel $model): TodoEntity;
    public function getAll(): Collection;
}
