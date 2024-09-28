<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('vendor')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        '@PHP80Migration:risky' => true,
        '@PHP83Migration' => true,
        'php_unit_internal_class' => false,
        'php_unit_test_class_requires_covers' => false,
        'php_unit_strict' => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);