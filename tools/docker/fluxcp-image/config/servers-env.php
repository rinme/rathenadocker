<?php

$userConfig = include __DIR__ . '/servers.php';

$dbHost = getenv('DB_HOST') ?: 'db';
$dbUser = getenv('DB_USER') ?: 'ragnarok';
$dbPass = getenv('DB_PASSWORD') ?: 'ragnarok';
$dbName = getenv('DB_NAME') ?: 'ragnarok';

$dockerConfig = [
    0 => [
        'ServerName' => getenv('RO_SERVER_NAME') ?: 'rAthena',
        'DbConfig' => [
            'Hostname' => $dbHost,
            'Username' => $dbUser,
            'Password' => $dbPass,
            'Database' => $dbName,
        ],
        'LogsDbConfig' => [
            'Hostname' => $dbHost,
            'Username' => $dbUser,
            'Password' => $dbPass,
            'Database' => $dbName,
        ],
        'LoginServer' => [
            'Address' => getenv('LOGIN_SERVER_HOST') ?: 'login',
        ],
        'CharMapServers' => [
            0 => [
                'ServerName' => getenv('RO_SERVER_NAME') ?: 'rAthena',
                'CharServer' => [
                    'Address' => getenv('CHAR_SERVER_HOST') ?: 'char',
                ],
                'MapServer' => [
                    'Address' => getenv('MAP_SERVER_HOST') ?: 'map',
                ],
            ],
        ],
    ],
];

return array_replace_recursive($userConfig, $dockerConfig);
