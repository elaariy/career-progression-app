<?php

Flight::route('GET /project-users', function () {
    Flight::json(Flight::project_user_service()->get_all(), 200);
});

Flight::route('GET /project-users/@id:[0-9]+', function ($id) {
    Flight::json(Flight::project_user_service()->get_by_id($id), 200);
});

Flight::route('POST /project-users', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::project_user_service()->add($data), 201);
});

Flight::route('PUT /project-users/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::project_user_service()->update($data, $id), 200);
});

Flight::route('DELETE /project-users/@id:[0-9]+', function ($id) {
    Flight::project_user_service()->delete($id);
    Flight::json(['message' => 'Project user deleted.'], 200);
});
