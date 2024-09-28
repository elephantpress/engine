<?php

declare(strict_types=1);

namespace ElephantPress\Engine\PageMeta;

final readonly class Meta
{
    public function __construct(
        public string $path,
        public string $name,
        public string $title,
        public ?string $fileName = null,
        public ?array $children = []
    ) {}

    /**
     * @throws \JsonException
     */
    public function makeChildren(MetaTree $finder): self
    {
        if ($finder->isDir($this)) {
            $children = $finder->loadMeta($this->path. $this->name);

            return new self($this->path, $this->name, $this->title, null, $children);
        }

        return $this;
    }
}
