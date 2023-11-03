<?php

namespace App\Http\ViewModels;

use Data\Entities\Entity;
use Data\Entities\TodoEntity;

class TodoViewModel extends ViewModel
{
    protected array $excludeFields = ['createdAt', 'updatedAt'];

    public function __construct(Entity $entity)
    {
        parent::__construct($entity);

        // NOTE: ViewModelレベルでappendしたい場合はここに入れる
    }
}
