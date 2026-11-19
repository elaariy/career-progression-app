<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path === '/') {
    header('Location: /frontend/');
    return true;
}

if ($path === '/backend' || strpos($path, '/backend/') === 0) {
    $_SERVER['SCRIPT_NAME'] = '/backend/index.php';
    require __DIR__ . '/backend/index.php';
    return true;
}

if (strpos($path, '/frontend/') === 0) {
    return false;
}

http_response_code(404);
return true;