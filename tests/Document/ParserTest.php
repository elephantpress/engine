<?php

declare(strict_types=1);

namespace ElephantPress\Engine\Tests\Document;

use ElephantPress\Engine\Document\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testParse(): void
    {
        $source = <<<'EOF'
            ---
            tags:
                - Hello
                - World
            date: '2021-01-01'
            ---
            # Hello, World!

            This is a test document.
            EOF;
        $data = Parser::parse($source);
        self::assertSame(['tags' => ['Hello', 'World'], 'date' => '2021-01-01'], $data['metadata']);
        self::assertSame('2021-01-01', $data['metadata']['date']);
        self::assertSame('Hello, World!', $data['title']);
        self::assertSame('# Hello, World!

This is a test document.', $data['content']);
        self::assertSame("<h1>Hello, World!</h1>\n<p>This is a test document.</p>", $data['html']);
    }
}
