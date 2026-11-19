<?php

require_once __DIR__ . '/vendor/autoload.php';

Flight::route('GET /', function () {
    Flight::json([
        'app' => 'CareerPath API',
        'message' => 'The backend is running.',
    ]);
});

Flight::start();