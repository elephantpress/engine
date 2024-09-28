<?php

declare(strict_types=1);

namespace ElephantPress\Engine\Document;

final readonly class Document
{
    public function __construct(
        public string $title,
        public string $content,
        public string $html,
        public array $metadata = []
    ) {}

    public static function load(Loader $loader, string $path): self
    {
        $data = Parser::parse($loader->load($path));

        return new self($data['title'], $data['content'], $data['html'], $data['metadata']);
    }
}
