<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

if (!defined('API_BASE_URL')) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/backend/public/v1/docs/swagger.php';
    $path = preg_replace(
        '#public/v1/docs/swagger\.php$#',
        '',
        parse_url($requestUri, PHP_URL_PATH)
    );
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    define('API_BASE_URL', $scheme . '://' . $host . $path);
}

$files = array_merge(
    [__DIR__ . '/doc_setup.php'],
    glob(__DIR__ . '/paths/*.php')
);

foreach ($files as $file) {
    require_once $file;
}

$openApi = (new \OpenApi\Generator())->generate($files);

header('Content-Type: application/json');
echo $openApi->toJson();