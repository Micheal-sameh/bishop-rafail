<?php

namespace App\DTOs;

class SubjectDataDTO extends DTO
{
    public ?string $title;

    public ?int $year;

    public function __construct(
        string $title = parent::STRING,
        int $year = parent::INT,
    ) {
        parent::__construct(compact(...$this->getParameterList()));
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: (string) ($data['title'] ?? parent::STRING),
            year: (int) ($data['year'] ?? parent::INT),
        );
    }
}
