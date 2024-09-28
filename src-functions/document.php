<?php

declare(strict_types=1);

namespace Elephantpress\Engine\Functions\Document;

function fileNameNormalizer(string $path): string
{
    if (false !== strrpos($path, '/')) {
        $path .= 'index.md';
    }

    return $path;
}

function buildFilePath(string $basePath, string $path): string
{
    $path = fileNameNormalizer($path);

    return rtrim($basePath, '/').'/'.ltrim($path, '/');
}
