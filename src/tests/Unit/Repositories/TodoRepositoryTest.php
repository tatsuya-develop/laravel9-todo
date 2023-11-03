<?php

namespace Tests\Unit\Repositories;

use Data\Entities\TodoEntity;
use Database\Factories\TodoFactory;
use Domain\Repositories\TodoRepositoryInterface;
use Illuminate\Support\Facades\App;
use Infrastructure\EloquentModels\Todo as TodoModel;
use Tests\Support\TestCase;

class TodoRepositoryTest extends TestCase
{
    private TodoRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = App::make(TodoRepositoryInterface::class);
    }

    /**
     * toEntityのテスト
     * @test
     */
    public function successToEntity(): void
    {
        $model = TodoFactory::new()->createOne();
        $entity = $this->repository->toEntity($model);

        $this->assertEquals($model->id, $entity->getIdValue());
        $this->assertEquals($model->task, $entity->getTaskValue());
        $this->assertEquals($model->completed, $entity->getCompletedValue());
    }

    /**
     * getAllのテスト
     * @test
     */
    public function successGetAll(): void
    {
        $todoModels = TodoFactory::new()->count(3)->create();
        $factory_entities = $todoModels->map(fn (TodoModel $m) => $this->repository->toEntity($m));
        $entities = $this->repository->getAll();

        $this->assertCount(3, $entities);
        $this->assertTodoEntities($factory_entities->toArray(), $entities->toArray());
    }

    private function assertTodoEntities(array $expectedEntities, array $actualEntities): void
    {
        $count = count($expectedEntities);
        for ($i = 0; $i < $count; $i++) {
            $this->assertTodoEntity($expectedEntities[$i], $actualEntities[$i]);
        }
    }

    private function assertTodoEntity(TodoEntity $expectedEntity, TodoEntity $actualEntity): void
    {
        $this->assertEquals($expectedEntity->getIdValue(), $actualEntity->getIdValue());
        $this->assertEquals($expectedEntity->getTaskValue(), $actualEntity->getTaskValue());
        $this->assertEquals($expectedEntity->getCompletedValue(), $actualEntity->getCompletedValue());
    }
}
