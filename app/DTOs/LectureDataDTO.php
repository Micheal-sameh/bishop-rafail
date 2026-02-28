<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

class LectureDataDTO extends DTO
{
    public ?string $title;

    public ?string $url;

    public ?UploadedFile $media;

    public ?int $subject_id;

    public function __construct(
        string $title = parent::STRING,
        string $url = parent::STRING,
        ?UploadedFile $media = null,
        int $subject_id = parent::INT,
    ) {
        parent::__construct(compact(...$this->getParameterList()));
    }

    public static function fromArray(array $data, ?UploadedFile $media = null): self
    {
        return new self(
            title: (string) ($data['title'] ?? parent::STRING),
            url: (string) ($data['url'] ?? parent::STRING),
            media: $media,
            subject_id: (int) ($data['subject_id'] ?? parent::INT),
        );
    }
}
