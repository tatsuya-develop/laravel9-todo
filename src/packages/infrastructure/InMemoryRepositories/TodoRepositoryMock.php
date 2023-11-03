<?php

namespace Infrastructure\InMemoryRepositories;

use App\Exceptions\ValidationErrorException;
use Data\Entities\TodoEntity;
use Domain\Repositories\TodoRepositoryInterface;
use Illuminate\Support\Collection;
use Infrastructure\EloquentModels\Todo as TodoModel;

class TodoRepositoryMock extends RepositoryMock implements TodoRepositoryInterface, RepositoryMockInterface
{
    /**
     * @throws ValidationErrorException
     */
    public function toEntity(TodoModel $model): TodoEntity
    {
        return new TodoEntity($model->toArray());
    }

    public function getAll(): Collection
    {
        return $this->getData();
    }
}
