<?php

$userConfig = include __DIR__ . '/application.php';

$dockerConfig = [
    'ServerAddress' => getenv('DOMAIN') ?: 'localhost',
    'BaseURI' => getenv('BASE_PATH') ?: '',
    'InstallerPassword' => getenv('INSTALLER_PASSWORD') ?: 'secretpassword',
    'SiteTitle' => getenv('SITE_TITLE') ?: 'Flux Control Panel',
];

return array_replace($userConfig, $dockerConfig);
