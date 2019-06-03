<?php

// PHP Coding Standards Fixer 配置文件
// 详情请访问： https://cs.sensiolabs.org/

$finder = PhpCsFixer\Finder::create()
    ->exclude('test')
    ->exclude('vendor')
    ->notPath('some_special_file.php')
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        // overwrite @Symfony rules:
        'binary_operator_spaces' => [
            // 'align', 'align_single_space', 'align_single_space_minimal',
            // 'no_space', 'single_space'; defaults to 'single_space'
            'default' => 'align_single_space_minimal',
        ],
        'phpdoc_summary' => false,
        // custom rules:
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'phpdoc_add_missing_param_annotation' => [
            'only_untyped' => false,
        ],
        'psr4'         => true,
        'phpdoc_order' => true,
    ])
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__.'/.php_cs.cache')
    ->setFinder($finder)
;
