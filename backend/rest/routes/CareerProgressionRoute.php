<?php

Flight::route('GET /career-progressions', function () {
    Flight::json(Flight::career_progression_service()->get_all(), 200);
});

Flight::route('GET /career-progressions/@id:[0-9]+', function ($id) {
    Flight::json(Flight::career_progression_service()->get_by_id($id), 200);
});

Flight::route('POST /career-progressions', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::career_progression_service()->add($data), 201);
});

Flight::route('PUT /career-progressions/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::career_progression_service()->update($data, $id), 200);
});

Flight::route('DELETE /career-progressions/@id:[0-9]+', function ($id) {
    Flight::career_progression_service()->delete($id);
    Flight::json(['message' => 'Career progression deleted.'], 200);
});
