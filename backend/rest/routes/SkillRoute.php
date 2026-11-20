<?php

Flight::route('GET /skills', function () {
    Flight::json(Flight::skill_service()->get_all());
});

Flight::route('GET /skills/@id:[0-9]+', function ($id) {
    Flight::json(Flight::skill_service()->get_by_id($id));
});

Flight::route('POST /skills', function () {
    $data = Flight::request()->data->getData();

    Flight::json(Flight::skill_service()->add($data), 201);
});

Flight::route('PUT /skills/@id:[0-9]+', function($id) {
    $data = Flight::request()->data->getData();

    Flight::json(Flight::skill_service()->update($data, $id));
});

Flight::route('DELETE /skills/@id:[0-9]+', function ($id) {
    Flight::skill_service()->delete($id);

    Flight::json(['message' => 'Skill deleted.']);
});