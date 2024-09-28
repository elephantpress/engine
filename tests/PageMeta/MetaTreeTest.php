<?php

declare(strict_types=1);

namespace ElephantPress\Engine\Tests\PageMeta;

use ElephantPress\Engine\PageMeta\Meta;
use ElephantPress\Engine\PageMeta\MetaTree;
use PHPUnit\Framework\TestCase;

class MetaTreeTest extends TestCase
{
    public function testFind(): void
    {
        $finder = new MetaTree();
        $meta = $finder->find(__DIR__.'/pages');

        $expected = [
            new Meta(__DIR__.'/pages', 'index', 'ElephantPress TOP', 'index.md'),
            new Meta(__DIR__.'/pages', 'start', 'ElephantPress Child', null, [
                new Meta(__DIR__.'/pages/start', 'index', 'Start Page', 'index.md'),
            ]),
        ];

        self::assertEquals($expected, $meta);
    }
}
