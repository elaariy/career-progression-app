<?php

Flight::route('GET /users', function () {
    Flight::json(Flight::user_service()->get_all(), 200);
});

Flight::route('GET /users/@id:[0-9]+', function ($id) {
    Flight::json(Flight::user_service()->get_by_id($id), 200);
});

Flight::route('POST /users', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::user_service()->add($data), 201);
});

Flight::route('PUT /users/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::user_service()->update($data, $id), 200);
});

Flight::route('DELETE /users/@id:[0-9]+', function ($id) {
    Flight::user_service()->delete($id);
    Flight::json(['message' => 'User deleted.'], 200);
});
