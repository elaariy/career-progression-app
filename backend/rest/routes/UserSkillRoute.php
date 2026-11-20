<?php

Flight::route('GET /user-skills', function () {
    Flight::json(Flight::user_skill_service()->get_all(), 200);
});

Flight::route('GET /user-skills/@id:[0-9]+', function ($id) {
    Flight::json(Flight::user_skill_service()->get_by_id($id), 200);
});

Flight::route('POST /user-skills', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::user_skill_service()->add($data), 201);
});

Flight::route('PUT /user-skills/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::user_skill_service()->update($data, $id), 200);
});

Flight::route('DELETE /user-skills/@id:[0-9]+', function ($id) {
    Flight::user_skill_service()->delete($id);
    Flight::json(['message' => 'User skill deleted.'], 200);
});
