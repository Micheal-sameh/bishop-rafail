<?php

namespace App\DTOs;

class LectureFilterDTO extends DTO
{
    public ?int $subject_id;

    public function __construct(
        int $subject_id = parent::INT,
    ) {
        parent::__construct(compact(...$this->getParameterList()));
    }

    public static function fromArray(array $data): self
    {
        return new self(
            subject_id: (int) ($data['subject_id'] ?? parent::INT),
        );
    }
}
