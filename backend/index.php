<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/utils/exceptions.php';

Flight::map('error', function (Throwable $e) {
    if ($e instanceof HttpException) {
        $status = $e->get_status();
        $message = $e->getMessage();
    } else {
        error_log((string) $e);
        $status = 500;
        $message = 'Something went wrong on the server.';
    }

    Flight::response()
        ->clearBody()
        ->status($status)
        ->header('Content-Type', 'application/json')
        ->write(json_encode(['error' => $message]))
        ->send();
});

Flight::map('notFound', function () {
    Flight::response()
        ->clearBody()
        ->status(404)
        ->header('Content-Type', 'application/json')
        ->write(json_encode(['error' => 'Endpoint not found.']))
        ->send();
});

require_once __DIR__ . '/rest/services/SkillService.php';
Flight::register('skill_service', 'SkillService');

Flight::route('GET /', function () {
    Flight::json([
        'app' => 'CareerPath API',
        'message' => 'The backend is running.',
    ]);
});

require_once __DIR__ . '/rest/routes/SkillRoute.php';

require_once __DIR__ . '/rest/services/PositionService.php';
Flight::register('position_service', 'PositionService');
require_once __DIR__ . '/rest/routes/PositionRoute.php';

require_once __DIR__ . '/rest/services/CareerTypeService.php';
Flight::register('career_type_service', 'CareerTypeService');
require_once __DIR__ . '/rest/routes/CareerTypeRoute.php';

require_once __DIR__ . '/rest/services/RoleService.php';
Flight::register('role_service', 'RoleService');
require_once __DIR__ . '/rest/routes/RoleRoute.php';

require_once __DIR__ . '/rest/services/LevelService.php';
Flight::register('level_service', 'LevelService');
require_once __DIR__ . '/rest/routes/LevelRoute.php';

require_once __DIR__ . '/rest/services/ResourceService.php';
Flight::register('resource_service', 'ResourceService');
require_once __DIR__ . '/rest/routes/ResourceRoute.php';

require_once __DIR__ . '/rest/services/ProjectService.php';
Flight::register('project_service', 'ProjectService');
require_once __DIR__ . '/rest/routes/ProjectRoute.php';

require_once __DIR__ . '/rest/services/LevelPositionService.php';
Flight::register('level_position_service', 'LevelPositionService');
require_once __DIR__ . '/rest/routes/LevelPositionRoute.php';

require_once __DIR__ . '/rest/services/LevelSkillService.php';
Flight::register('level_skill_service', 'LevelSkillService');
require_once __DIR__ . '/rest/routes/LevelSkillRoute.php';

require_once __DIR__ . '/rest/services/UserService.php';
Flight::register('user_service', 'UserService');
require_once __DIR__ . '/rest/routes/UserRoute.php';

require_once __DIR__ . '/rest/services/UserSkillService.php';
Flight::register('user_skill_service', 'UserSkillService');
require_once __DIR__ . '/rest/routes/UserSkillRoute.php';

require_once __DIR__ . '/rest/services/ProjectUserService.php';
Flight::register('project_user_service', 'ProjectUserService');
require_once __DIR__ . '/rest/routes/ProjectUserRoute.php';

require_once __DIR__ . '/rest/services/UserResourceService.php';
Flight::register('user_resource_service', 'UserResourceService');
require_once __DIR__ . '/rest/routes/UserResourceRoute.php';

require_once __DIR__ . '/rest/services/CareerProgressionService.php';
Flight::register('career_progression_service', 'CareerProgressionService');
require_once __DIR__ . '/rest/routes/CareerProgressionRoute.php';

require_once __DIR__ . '/rest/services/ProgressionRequestService.php';
Flight::register('progression_request_service', 'ProgressionRequestService');
require_once __DIR__ . '/rest/routes/ProgressionRequestRoute.php';

require_once __DIR__ . '/rest/services/ProgressionCommentService.php';
Flight::register('progression_comment_service', 'ProgressionCommentService');
require_once __DIR__ . '/rest/routes/ProgressionCommentRoute.php';

Flight::start();