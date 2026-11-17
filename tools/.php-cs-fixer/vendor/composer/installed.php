<?php return array(
    'root' => array(
        'name' => '__root__',
        'pretty_version' => '8.0.x-dev',
        'version' => '8.0.9999999.9999999-dev',
        'reference' => 'e798446d7a88442f7e76cdaa6f559d5df8cec50e',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => '8.0.x-dev',
            'version' => '8.0.9999999.9999999-dev',
            'reference' => 'e798446d7a88442f7e76cdaa6f559d5df8cec50e',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'friendsofphp/php-cs-fixer' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => 'v3.95.31',
            ),
        ),
        'php-cs-fixer/shim' => array(
            'pretty_version' => 'v3.95.31',
            'version' => '3.95.31.0',
            'reference' => 'ecc5bd6c3a8151488dc6b9a81502655726bd0f1b',
            'type' => 'application',
            'install_path' => __DIR__ . '/../php-cs-fixer/shim',
            'aliases' => array(),
            'dev_requirement' => true,
        ),
    ),
);
