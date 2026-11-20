<?php

Flight::route('GET /level-positions', function () {
    Flight::json(Flight::level_position_service()->get_all(), 200);
});

Flight::route('GET /level-positions/@id:[0-9]+', function ($id) {
    Flight::json(Flight::level_position_service()->get_by_id($id), 200);
});

Flight::route('POST /level-positions', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::level_position_service()->add($data), 201);
});

Flight::route('PUT /level-positions/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::level_position_service()->update($data, $id), 200);
});

Flight::route('DELETE /level-positions/@id:[0-9]+', function ($id) {
    Flight::level_position_service()->delete($id);
    Flight::json(['message' => 'Level position deleted.'], 200);
});
