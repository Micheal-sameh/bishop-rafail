<?php

namespace App\DTOs;

use App\Attributes\HasEmptyPlaceholders;

#[HasEmptyPlaceholders]
class UsersFilterDTO extends DTO
{
    public ?string $name;

    public function __construct(
        string $name = parent::STRING,
    ) {
        parent::__construct(compact(...$this->getParameterList()));
    }
}
