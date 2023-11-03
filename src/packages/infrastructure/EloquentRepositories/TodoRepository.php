<?php

namespace Infrastructure\EloquentRepositories;

use App\Exceptions\ValidationErrorException;
use Data\Entities\TodoEntity;
use Domain\Repositories\TodoRepositoryInterface;
use Illuminate\Support\Collection;
use Infrastructure\EloquentModels\Todo as TodoModel;

class TodoRepository extends EloquentRepository implements TodoRepositoryInterface
{
    protected TodoModel $model;

    /**
     * @param TodoModel $model
     */
    public function __construct(TodoModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param TodoModel $model
     * @return TodoEntity
     * @throws ValidationErrorException
     */
    public function toEntity(TodoModel $model): TodoEntity
    {
        return new TodoEntity($model->toArray());
    }

    /**
     * @return Collection<TodoEntity[]>
     */
    public function getAll(): Collection
    {
        return $this->model->all()->map(fn ($data) => $this->toEntity($data));
    }
}
