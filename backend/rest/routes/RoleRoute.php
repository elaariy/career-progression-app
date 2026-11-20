<?php

Flight::route('GET /roles', function () {
    Flight::json(Flight::role_service()->get_all(), 200);
});

Flight::route('GET /roles/@id:[0-9]+', function ($id) {
    Flight::json(Flight::role_service()->get_by_id($id), 200);
});

Flight::route('POST /roles', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::role_service()->add($data), 201);
});

Flight::route('PUT /roles/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::role_service()->update($data, $id), 200);
});

Flight::route('DELETE /roles/@id:[0-9]+', function ($id) {
    Flight::role_service()->delete($id);
    Flight::json(['message' => 'Role deleted.'], 200);
});
