<?php

namespace Domain\UseCases\Todos;

use Domain\UseCases\UseCase;

interface ListUseCase extends UseCase
{
    public function phaseInvoke(): void;
}
