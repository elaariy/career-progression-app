<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/ProjectUserDao.php';
require_once __DIR__ . '/../dao/ProjectDao.php';
require_once __DIR__ . '/../dao/UserDao.php';

class ProjectUserService extends BaseService
{
    protected $entity_name = 'Project user';
    private $project_dao;
    private $user_dao;

    public function __construct()
    {
        parent::__construct(new ProjectUserDao());
        $this->project_dao = new ProjectDao();
        $this->user_dao = new UserDao();
    }

    protected function validate($entity, $id = null)
    {
        Validator::required($entity, ['project_id', 'user_id']);
        Validator::integer($entity['project_id'], 'project_id', 1);
        Validator::integer($entity['user_id'], 'user_id', 1);

        if ($this->project_dao->get_by_id($entity['project_id']) === null) {
            throw new ValidationException(
                'The selected project does not exist.'
            );
        }

        if ($this->user_dao->get_by_id($entity['user_id']) === null) {
            throw new ValidationException('The selected user does not exist.');
        }

        $existing = $this->dao->get_by_project_user(
            $entity['project_id'],
            $entity['user_id']
        );

        if ($existing && (int) $existing['id'] !== (int) $id) {
            throw new ValidationException(
                'This project and user pair already exists.'
            );
        }
    }
}
