<?php

declare(strict_types=1);

namespace ElephantPress\Engine\PageMeta;

final readonly class Meta
{
    public function __construct(
        public string $basePath,
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
        if (is_dir($this->basePath.'/'.$this->name)) {
            $children = $finder->loadMeta($this->basePath.'/'.$this->name);

            return new self($this->basePath, $this->name, $this->title, null, $children);
        }

        return $this;
    }
}
