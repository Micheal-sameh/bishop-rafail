<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

class SermonDataDTO extends DTO
{
    public ?string $title;

    public ?string $url;

    public ?UploadedFile $file;

    public ?int $sermon_playlist_id;

    public function __construct(
        string $title = parent::STRING,
        string $url = parent::STRING,
        ?UploadedFile $file = null,
        int $sermon_playlist_id = parent::INT,
    ) {
        parent::__construct(compact(...$this->getParameterList()));
    }

    public static function fromArray(array $data, ?UploadedFile $file = null): self
    {
        return new self(
            title: (string) ($data['title'] ?? parent::STRING),
            url: (string) ($data['url'] ?? parent::STRING),
            file: $file,
            sermon_playlist_id: (int) ($data['sermon_playlist_id'] ?? parent::INT),
        );
    }
}
