<?php

Flight::route('GET /career-types', function () {
    Flight::json(Flight::career_type_service()->get_all(), 200);
});

Flight::route('GET /career-types/@id:[0-9]+', function ($id) {
    Flight::json(Flight::career_type_service()->get_by_id($id), 200);
});

Flight::route('POST /career-types', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::career_type_service()->add($data), 201);
});

Flight::route('PUT /career-types/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::career_type_service()->update($data, $id), 200);
});

Flight::route('DELETE /career-types/@id:[0-9]+', function ($id) {
    Flight::career_type_service()->delete($id);
    Flight::json(['message' => 'Career type deleted.'], 200);
});
