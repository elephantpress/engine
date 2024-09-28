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
        $finder = new MetaTree(__DIR__.'/pages');
        $meta = $finder->find('/');

        $expected = [
            new Meta('/', 'index', 'ElephantPress TOP', 'index.md'),
            new Meta('/', 'start', 'ElephantPress Child', null, [
                new Meta('/start', 'index', 'Start Page', 'index.md'),
                new Meta('/start', 'end', 'End Page', 'end.md'),
            ]),
        ];

        self::assertEquals($expected, $meta);
    }
}
