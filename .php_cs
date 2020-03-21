<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    // default
    '@PSR2'                      => true,
    '@Symfony'                   => true,
    // additionally
    'array_syntax'               => ['syntax' => 'short'],
    'concat_space'               => false,
    'cast_spaces'                => false,
    'no_unused_imports'          => false,
    'no_useless_else'            => true,
    'no_useless_return'          => true,
    'no_superfluous_phpdoc_tags' => false,
    'ordered_imports'            => true,
    'phpdoc_align'               => true,
    'phpdoc_order'               => true,
    'phpdoc_trim'                => true,
    'phpdoc_summary'             => false,
    'simplified_null_return'     => false,
    'ternary_to_null_coalescing' => true,
    'binary_operator_spaces'     => ['default' => 'align'],
];

$finder = (new Finder())
    ->files()
    ->name('*.php')
    ->in(__DIR__ . '/src')
;

return (new Config('regon-api'))
    ->setRiskyAllowed(true)
    ->setRules($rules)
    ->setFinder($finder)
    ;
