<?php

namespace Infrastructure\Interactors\Todos;

use Domain\Repositories\TodoRepositoryInterface;
use Domain\UseCases\Todos\ListUseCase;
use Infrastructure\Interactors\Interactor;
use Infrastructure\Interactors\State;

class ListInteractor extends Interactor implements ListUseCase
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        parent::__construct(new State());

        $this->todoRepository = $todoRepository;
    }

    public function phaseInvoke(): void
    {
        $this->state->setResponse('todos', $this->todoRepository->getAll());
    }
}
