<?php

Flight::route('GET /level-skills', function () {
    Flight::json(Flight::level_skill_service()->get_all(), 200);
});

Flight::route('GET /level-skills/@id:[0-9]+', function ($id) {
    Flight::json(Flight::level_skill_service()->get_by_id($id), 200);
});

Flight::route('POST /level-skills', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::level_skill_service()->add($data), 201);
});

Flight::route('PUT /level-skills/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::level_skill_service()->update($data, $id), 200);
});

Flight::route('DELETE /level-skills/@id:[0-9]+', function ($id) {
    Flight::level_skill_service()->delete($id);
    Flight::json(['message' => 'Level skill deleted.'], 200);
});
