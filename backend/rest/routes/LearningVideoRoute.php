<?php

Flight::route('GET /learning-videos', function () {
    $query = Flight::request()->query['q'] ?? null;

    Flight::json(Flight::learning_video_service()->search($query));
});