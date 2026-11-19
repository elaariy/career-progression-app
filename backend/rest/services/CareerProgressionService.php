<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/CareerProgressionDao.php';
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/LevelPositionDao.php';

class CareerProgressionService extends BaseService
{
    protected $entity_name = 'Career progression';
    private $user_dao;
    private $level_position_dao;

    public function __construct()
    {
        parent::__construct(new CareerProgressionDao());
        $this->user_dao = new UserDao();
        $this->level_position_dao = new LevelPositionDao();
    }

    public function add($entity)
    {
        return parent::add($this->prepare($entity));
    }

    public function update($entity, $id)
    {
        return parent::update($this->prepare($entity), $id);
    }

    protected function validate($entity, $id = null)
    {
        Validator::required(
            $entity,
            ['user_id', 'level_position_id', 'start_date']
        );
        Validator::integer($entity['user_id'], 'user_id', 1);
        Validator::integer($entity['level_position_id'], 'level_position_id', 1);
        Validator::date($entity['start_date'], 'start_date');

        if ($this->user_dao->get_by_id($entity['user_id']) === null) {
            throw new ValidationException('The selected user does not exist.');
        }

        if (
            $this->level_position_dao->get_by_id(
                $entity['level_position_id']
            ) === null
        ) {
            throw new ValidationException(
                'The selected level position does not exist.'
            );
        }

        if (
            array_key_exists('end_date', $entity) &&
            $entity['end_date'] !== null
        ) {
            Validator::date($entity['end_date'], 'end_date');

            if ($entity['end_date'] < $entity['start_date']) {
                throw new ValidationException(
                    'End date cannot be before start date.'
                );
            }
        }

        if (
            array_key_exists('notes', $entity) &&
            $entity['notes'] !== null &&
            !is_string($entity['notes'])
        ) {
            throw new ValidationException('Notes must be text or null.');
        }
    }

    private function prepare($entity)
    {
        foreach (['start_date', 'end_date', 'notes'] as $field) {
            if (isset($entity[$field]) && is_string($entity[$field])) {
                $entity[$field] = trim($entity[$field]);
            }
        }

        if (array_key_exists('end_date', $entity) && $entity['end_date'] === '') {
            $entity['end_date'] = null;
        }

        return $entity;
    }
}
