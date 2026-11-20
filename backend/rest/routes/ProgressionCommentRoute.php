<?php

Flight::route('GET /progression-comments', function () {
    Flight::json(Flight::progression_comment_service()->get_all(), 200);
});

Flight::route('GET /progression-comments/@id:[0-9]+', function ($id) {
    Flight::json(Flight::progression_comment_service()->get_by_id($id), 200);
});

Flight::route('POST /progression-comments', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::progression_comment_service()->add($data), 201);
});

Flight::route('PUT /progression-comments/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::progression_comment_service()->update($data, $id), 200);
});

Flight::route('DELETE /progression-comments/@id:[0-9]+', function ($id) {
    Flight::progression_comment_service()->delete($id);
    Flight::json(['message' => 'Progression comment deleted.'], 200);
});
