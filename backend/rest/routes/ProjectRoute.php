<?php

Flight::route('GET /projects', function () {
    Flight::json(Flight::project_service()->get_all(), 200);
});

Flight::route('GET /projects/@id:[0-9]+', function ($id) {
    Flight::json(Flight::project_service()->get_by_id($id), 200);
});

Flight::route('POST /projects', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::project_service()->add($data), 201);
});

Flight::route('PUT /projects/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::project_service()->update($data, $id), 200);
});

Flight::route('DELETE /projects/@id:[0-9]+', function ($id) {
    Flight::project_service()->delete($id);
    Flight::json(['message' => 'Project deleted.'], 200);
});
