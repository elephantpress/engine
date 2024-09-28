<?php

declare(strict_types=1);

namespace ElephantPress\Engine\Document;

use Symfony\Component\Yaml\Yaml;

final class Parser
{
    private const METADATA_START = '/^---\n/';
    private const METADATA_END = '/\n---\n/';

    public static function parse(string $source): array
    {
        $document = [
            'metadata' => [],
            'content' => $source,
        ];

        if (preg_match(self::METADATA_START, $source)) {
            $sections = preg_split(self::METADATA_END, preg_replace(self::METADATA_START, '', $source), 2);

            if (2 === \count($sections)) {
                if (!empty(trim($sections[0]))) {
                    $document['metadata'] = Yaml::parse(trim($sections[0]));
                }

                $document['content'] = $sections[1];
            }
        }

        // title
        $pattern = '/^# (.+)$/m'; // m フラグは複数行の処理に必要
        if (preg_match_all($pattern, $document['content'], $matches)) {
            $document['title'] = $matches[1][0];
        }

        $document['html'] = \Parsedown::instance()->text($document['content']);

        return $document;
    }
}
