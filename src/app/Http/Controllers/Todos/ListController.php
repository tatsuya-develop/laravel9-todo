<?php

namespace App\Http\Controllers\Todos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todos\ListRequest;
use App\Http\Translators\TodoTranslator;
use App\Http\ViewModels\TodoViewModel;
use Domain\UseCases\Todos\ListUseCase;
use Illuminate\Support\Collection;

class ListController extends Controller
{
    private ListUseCase $interactor;

    public function __construct(ListRequest $request, ListUseCase $interactor)
    {
        parent::__construct($request);

        $this->interactor = $interactor;
    }

    /**
     * @return Collection<TodoViewModel[]>
     */
    public function phaseInvoke(): Collection
    {
        $todos = $this->interactor->invokeStrict()->getResponse('todos');
        return TodoTranslator::translate($todos);
    }
}
