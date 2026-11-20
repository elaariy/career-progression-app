<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/UserResourceDao.php';
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/ResourceDao.php';

class UserResourceService extends BaseService
{
    protected $entity_name = 'User resource';
    private $user_dao;
    private $resource_dao;

    public function __construct()
    {
        parent::__construct(new UserResourceDao());
        $this->user_dao = new UserDao();
        $this->resource_dao = new ResourceDao();
    }

    protected function validate($entity, $id = null)
    {
        Validator::required($entity, ['user_id', 'resource_id']);
        Validator::integer($entity['user_id'], 'user_id', 1);
        Validator::integer($entity['resource_id'], 'resource_id', 1);

        if ($this->user_dao->get_by_id($entity['user_id']) === null) {
            throw new ValidationException('The selected user does not exist.');
        }

        if ($this->resource_dao->get_by_id($entity['resource_id']) === null) {
            throw new ValidationException(
                'The selected resource does not exist.'
            );
        }

        $existing = $this->dao->get_by_user_resource(
            $entity['user_id'],
            $entity['resource_id']
        );

        if ($existing && (int) $existing['id'] !== (int) $id) {
            throw new ValidationException(
                'This user and resource pair already exists.'
            );
        }
    }
}
