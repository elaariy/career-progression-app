<?php

Flight::route('GET /user-resources', function () {
    Flight::json(Flight::user_resource_service()->get_all(), 200);
});

Flight::route('GET /user-resources/@id:[0-9]+', function ($id) {
    Flight::json(Flight::user_resource_service()->get_by_id($id), 200);
});

Flight::route('POST /user-resources', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::user_resource_service()->add($data), 201);
});

Flight::route('PUT /user-resources/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::user_resource_service()->update($data, $id), 200);
});

Flight::route('DELETE /user-resources/@id:[0-9]+', function ($id) {
    Flight::user_resource_service()->delete($id);
    Flight::json(['message' => 'User resource deleted.'], 200);
});
