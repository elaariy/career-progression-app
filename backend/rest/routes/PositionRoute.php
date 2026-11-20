<?php

Flight::route('GET /positions', function () {
    Flight::json(Flight::position_service()->get_all(), 200);
});

Flight::route('GET /positions/@id:[0-9]+', function ($id) {
    Flight::json(Flight::position_service()->get_by_id($id), 200);
});

Flight::route('POST /positions', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::position_service()->add($data), 201);
});

Flight::route('PUT /positions/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::position_service()->update($data, $id), 200);
});

Flight::route('DELETE /positions/@id:[0-9]+', function ($id) {
    Flight::position_service()->delete($id);
    Flight::json(['message' => 'Position deleted.'], 200);
});
