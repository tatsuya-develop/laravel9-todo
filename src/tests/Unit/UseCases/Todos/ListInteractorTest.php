<?php

namespace Tests\Unit\UseCases\Todos;

use Database\Factories\TodoFactory;
use Domain\Repositories\TodoRepositoryInterface;
use Domain\UseCases\Todos\ListUseCase;
use Illuminate\Support\Facades\App;
use Infrastructure\InMemoryRepositories\RepositoryMockInterface;
use Infrastructure\InMemoryRepositories\TodoRepositoryMock;
use Tests\Factory\Repositories\TodoRepositoryMockFactory;
use Tests\Support\TestCase;

class ListInteractorTest extends TestCase
{
    private TodoRepositoryInterface|RepositoryMockInterface $todoRepository;

    /**
     * @test
     * @return void
     */
    public function successInvoke(): void
    {
        $this->todoRepository = new TodoRepositoryMock();
        App::instance(TodoRepositoryInterface::class, $this->todoRepository);

        $interactor = App::make(ListUseCase::class);

        $initEntities = TodoFactory::new()->count(3)->make()->map(fn($m) => $this->todoRepository->toEntity(($m)));
        $this->todoRepository->setData($initEntities);

        $state = $interactor->invokeStrict();

        $this->assertFalse($state->isError());
        $this->assertCount(3, $state->getResponse('todos'));
    }
}
