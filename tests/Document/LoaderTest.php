<?php

declare(strict_types=1);

namespace ElephantPress\Engine\Tests\Document;

use ElephantPress\Engine\Document\Loader;
use PHPUnit\Framework\TestCase;

class LoaderTest extends TestCase
{
    public function testLoad(): void
    {
        $loader = new Loader(__DIR__.'/pages');

        $expected = <<<'EOF'
            ---
            date: '2024-09-28'
            ---
            # Welcome to ElephantPress

            ElephantPress is a markdown site generator built with PHP.
            EOF;

        self::assertSame($expected, $loader->load('/index.md'));
    }
}
