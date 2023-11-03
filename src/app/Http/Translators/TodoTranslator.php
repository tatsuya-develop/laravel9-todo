<?php

namespace App\Http\Translators;

use App\Http\ViewModels\TodoViewModel;
use Data\Entities\TodoEntity;
use Illuminate\Support\Collection;

class TodoTranslator extends Translator
{
    /**
     * @param Collection<TodoEntity[]> $entities
     * @return Collection<TodoViewModel[]>
     */
    public static function translate(Collection $entities): Collection
    {
        // TODO: ViewModel生成に必要なデータをrepository経由で取得する

        return $entities->map(function (TodoEntity $e) {
            return (new TodoViewModel($e))->generate();
        });
    }
}
