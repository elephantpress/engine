<?php

declare(strict_types=1);

namespace ElephantPress\Engine\Document;

use function ElephantPress\Engine\Functions\Document\buildFilePath;

final readonly class Loader
{
    public function __construct(private string $basePath) {}

    public function load(string $path): string
    {
        $filePath = buildFilePath($this->basePath, $path);
        if (!file_exists($filePath)) {
            throw new \RuntimeException('file not found: '.$filePath);
        }

        $source = file_get_contents($filePath);
        if (!$source) {
            throw new \RuntimeException('file read error');
        }

        return $source;
    }
}
