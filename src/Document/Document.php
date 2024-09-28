<?php

declare(strict_types=1);

namespace ElephantPress\Engine\Document;

use function Elephantpress\Engine\Functions\Document\fileNameNormalizer;

final readonly class Document
{
    public function __construct(
        public string $path,
        public string $title,
        public string $content,
        public string $html,
        public array $metadata = []
    ) {}

    public static function load(Loader $loader, string $path): self
    {
        $path = fileNameNormalizer($path);
        $data = Parser::parse($loader->load($path));

        return new self($path, $data['title'], $data['content'], $data['html'], $data['metadata']);
    }
}
