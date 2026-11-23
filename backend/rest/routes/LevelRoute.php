<?php

Flight::route('GET /levels', function () {
    Flight::json(Flight::level_service()->get_all(), 200);
});

Flight::route('GET /levels/@id:[0-9]+', function ($id) {
    Flight::json(Flight::level_service()->get_by_id($id), 200);
});

Flight::route('POST /levels', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::level_service()->add($data), 201);
});

Flight::route('PUT /levels/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::level_service()->update($data, $id), 200);
});

Flight::route('DELETE /levels/@id:[0-9]+', function ($id) {
    Flight::level_service()->delete($id);
    Flight::json(['message' => 'Level deleted.'], 200);
});
