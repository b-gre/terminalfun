<?php

declare(strict_types=1);

return (function () {
    $finder = PhpCsFixer\Finder::create()
        ->ignoreVCSIgnored(true)
        ->in(__DIR__);

    $config = new PhpCsFixer\Config();
    $config
        ->setRiskyAllowed(true)
        ->setRules([
            '@Symfony' => true,
            'array_indentation' => true,
            'explicit_indirect_variable' => true,
            'escape_implicit_backslashes' => true,
            'explicit_string_variable' => true,
            'simple_to_complex_string_variable' => true,
            'ordered_class_elements' => [
                'order' => [
                    'use_trait',
                    'case',
                    'constant_public',
                    'constant_protected',
                    'constant_private',
                    'property_public',
                    'property_protected',
                    'property_private',
                    'construct',
                    'destruct',
                    'magic',
                    'phpunit',
                    'method_public',
                    'method_protected',
                    'method_private',
                ],
            ],
        ])
        ->setFinder($finder);

    return $config;
})();
