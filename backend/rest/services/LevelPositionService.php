<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/LevelPositionDao.php';
require_once __DIR__ . '/../dao/LevelDao.php';
require_once __DIR__ . '/../dao/PositionDao.php';

class LevelPositionService extends BaseService
{
    protected $entity_name = 'Level position';
    private $level_dao;
    private $position_dao;

    public function __construct()
    {
        parent::__construct(new LevelPositionDao());
        $this->level_dao = new LevelDao();
        $this->position_dao = new PositionDao();
    }

    protected function validate($entity, $id = null)
    {
        Validator::required($entity, ['level_id', 'position_id']);
        Validator::integer($entity['level_id'], 'level_id', 1);
        Validator::integer($entity['position_id'], 'position_id', 1);

        if ($this->level_dao->get_by_id($entity['level_id']) === null) {
            throw new ValidationException('The selected level does not exist.');
        }

        if ($this->position_dao->get_by_id($entity['position_id']) === null) {
            throw new ValidationException(
                'The selected position does not exist.'
            );
        }

        $existing = $this->dao->get_by_level_position(
            $entity['level_id'],
            $entity['position_id']
        );

        if ($existing && (int) $existing['id'] !== (int) $id) {
            throw new ValidationException(
                'This level and position pair already exists.'
            );
        }
    }
}
