<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/UserSkillDao.php';
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/SkillDao.php';

class UserSkillService extends BaseService
{
    protected $entity_name = 'User skill';
    private $user_dao;
    private $skill_dao;

    public function __construct()
    {
        parent::__construct(new UserSkillDao());
        $this->user_dao = new UserDao();
        $this->skill_dao = new SkillDao();
    }

    protected function validate($entity, $id = null)
    {
        Validator::required($entity, ['user_id', 'skill_id']);
        Validator::integer($entity['user_id'], 'user_id', 1);
        Validator::integer($entity['skill_id'], 'skill_id', 1);

        if ($this->user_dao->get_by_id($entity['user_id']) === null) {
            throw new ValidationException('The selected user does not exist.');
        }

        if ($this->skill_dao->get_by_id($entity['skill_id']) === null) {
            throw new ValidationException('The selected skill does not exist.');
        }

        if (
            array_key_exists('progress_percent', $entity) &&
            $entity['progress_percent'] !== null
        ) {
            Validator::integer(
                $entity['progress_percent'],
                'progress_percent',
                0,
                100
            );
        }

        if (
            array_key_exists('is_completed', $entity) &&
            $entity['is_completed'] !== null &&
            !is_bool($entity['is_completed']) &&
            !in_array($entity['is_completed'], [0, 1, '0', '1'], true)
        ) {
            throw new ValidationException(
                'is_completed must be a boolean or null.'
            );
        }

        $existing = $this->dao->get_by_user_skill(
            $entity['user_id'],
            $entity['skill_id']
        );

        if ($existing && (int) $existing['id'] !== (int) $id) {
            throw new ValidationException(
                'This user and skill pair already exists.'
            );
        }
    }
}
