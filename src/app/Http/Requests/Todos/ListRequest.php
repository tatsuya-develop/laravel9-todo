<?php

namespace App\Http\Requests\Todos;

use App\Http\Requests\Request;

class ListRequest extends Request
{
    public function authorize(): bool
    {
        return parent::authorize();
    }

    public function rules(): array
    {
        return parent::rules();
    }
}
