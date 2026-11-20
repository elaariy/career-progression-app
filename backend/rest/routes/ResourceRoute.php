<?php

Flight::route('GET /resources', function () {
    Flight::json(Flight::resource_service()->get_all(), 200);
});

Flight::route('GET /resources/@id:[0-9]+', function ($id) {
    Flight::json(Flight::resource_service()->get_by_id($id), 200);
});

Flight::route('POST /resources', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::resource_service()->add($data), 201);
});

Flight::route('PUT /resources/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::resource_service()->update($data, $id), 200);
});

Flight::route('DELETE /resources/@id:[0-9]+', function ($id) {
    Flight::resource_service()->delete($id);
    Flight::json(['message' => 'Resource deleted.'], 200);
});
