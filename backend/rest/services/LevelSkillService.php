<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/LevelSkillDao.php';
require_once __DIR__ . '/../dao/LevelDao.php';
require_once __DIR__ . '/../dao/SkillDao.php';

class LevelSkillService extends BaseService
{
    protected $entity_name = 'Level skill';
    private $level_dao;
    private $skill_dao;

    public function __construct()
    {
        parent::__construct(new LevelSkillDao());
        $this->level_dao = new LevelDao();
        $this->skill_dao = new SkillDao();
    }

    protected function validate($entity, $id = null)
    {
        Validator::required($entity, ['level_id', 'skill_id']);
        Validator::integer($entity['level_id'], 'level_id', 1);
        Validator::integer($entity['skill_id'], 'skill_id', 1);

        if ($this->level_dao->get_by_id($entity['level_id']) === null) {
            throw new ValidationException('The selected level does not exist.');
        }

        if ($this->skill_dao->get_by_id($entity['skill_id']) === null) {
            throw new ValidationException('The selected skill does not exist.');
        }

        $existing = $this->dao->get_by_level_skill(
            $entity['level_id'],
            $entity['skill_id']
        );

        if ($existing && (int) $existing['id'] !== (int) $id) {
            throw new ValidationException(
                'This level and skill pair already exists.'
            );
        }
    }
}
