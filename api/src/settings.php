<?php

/** @var \Dotenv\Dotenv $dotenv */
$dotenv = new Dotenv\Dotenv(__DIR__ . "/..", ".env");
$dotenv->load();

return [
    'settings' => [
        // If you put SLIMAPI in production, change it to false
        'displayErrorDetails' => true,

        // Renderer settings: where are the templates???
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings: where are the logs???
        'logger' => [
            'name' => 'SLIMAPI',
            'path' => __DIR__ . '/../logs/app.log',
        ],
        'admin_users' => [
            getenv('ADMIN_USER') => getenv('ADMIN_PASS')
        ],
        'security_token' => getenv('SECURITY_TOKEN'),
        'base_dir' => getenv('BASE_DIR'),

        
    ],
];
