<?php

namespace App\DTOs;

class SubjectFilterDTO extends DTO
{
    public ?int $year;

    public function __construct(
        int $year = parent::INT,
    ) {
        parent::__construct(compact(...$this->getParameterList()));
    }

    public static function fromArray(array $data): self
    {
        return new self(
            year: (int) ($data['year'] ?? parent::INT),
        );
    }
}
