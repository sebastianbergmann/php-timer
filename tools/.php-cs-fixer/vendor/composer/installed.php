<?php return array(
    'root' => array(
        'name' => '__root__',
        'pretty_version' => '8.0.x-dev',
        'version' => '8.0.9999999.9999999-dev',
        'reference' => 'a2c2073145aa46bb323cb9d0a2d86d96ab61c59e',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => '8.0.x-dev',
            'version' => '8.0.9999999.9999999-dev',
            'reference' => 'a2c2073145aa46bb323cb9d0a2d86d96ab61c59e',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'friendsofphp/php-cs-fixer' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => 'v3.95.32',
            ),
        ),
        'php-cs-fixer/shim' => array(
            'pretty_version' => 'v3.95.32',
            'version' => '3.95.32.0',
            'reference' => 'c95a290fc4486d4a68fb75f88d7b166f4141686a',
            'type' => 'application',
            'install_path' => __DIR__ . '/../php-cs-fixer/shim',
            'aliases' => array(),
            'dev_requirement' => true,
        ),
    ),
);
