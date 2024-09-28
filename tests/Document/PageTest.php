<?php

declare(strict_types=1);

namespace ElephantPress\Engine\Tests\Document;

use ElephantPress\Engine\Document\Document;
use ElephantPress\Engine\Document\Loader;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    public function testRender(): void
    {
        $page = Document::load(new Loader(__DIR__.'/pages'), '/');
        self::assertSame('Welcome to ElephantPress', $page->title);
        $expected = <<<'EOF'
            # Welcome to ElephantPress

            ElephantPress is a markdown site generator built with PHP.
            EOF;

        self::assertSame($expected, $page->content);
        self::assertSame("<h1>Welcome to ElephantPress</h1>\n<p>ElephantPress is a markdown site generator built with PHP.</p>", $page->html);
        self::assertSame(['date' => '2024-09-28'], $page->metadata);
    }
}
