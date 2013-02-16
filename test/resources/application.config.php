<?php
return array(
    'modules' => array(
        'Application',
        'WebinoCanonicalRedirect',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            'WebinoCanonicalRedirect' => __DIR__ . '/../..',
            './module',
            './vendor',
        ),
    ),
);
