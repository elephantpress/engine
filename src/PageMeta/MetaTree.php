<?php

declare(strict_types=1);

namespace ElephantPress\Engine\PageMeta;

final readonly class MetaTree
{
    public function __construct(private string $basePath)
    {
    }

    /**
     * @param mixed $path
     *
     * @throws \JsonException
     */
    public function find(string $path): array
    {
        return array_map(fn (Meta $meta) => $meta->makeChildren($this), $this->loadMeta($path));
    }

    /**
     * @throws \JsonException
     */
    public function loadMeta(string $path): array
    {
        $fileName = $this->basePath . $path. '/_meta.json';
        if (!file_exists($fileName)) {
            return [];
        }
        $file = file_get_contents($fileName);
        $json = json_decode($file, true, 512, JSON_THROW_ON_ERROR);
        $meta = [];
        foreach ($json as $pageName => $title) {
            $meta[] = new Meta($path, $pageName, $title, $pageName.'.md');
        }

        return $meta;
    }

    public function isDir(Meta $meta): bool
    {
        return is_dir($this->basePath . $meta->path.'/'.$meta->name);
    }
}
