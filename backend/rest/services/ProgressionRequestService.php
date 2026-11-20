<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/ProgressionRequestDao.php';
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/LevelPositionDao.php';

class ProgressionRequestService extends BaseService
{
    protected $entity_name = 'Progression request';
    private $user_dao;
    private $level_position_dao;

    public function __construct()
    {
        parent::__construct(new ProgressionRequestDao());
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
            ['user_id', 'from_level_position_id', 'to_level_position_id']
        );

        foreach (
            ['user_id', 'from_level_position_id', 'to_level_position_id']
            as $field
        ) {
            Validator::integer($entity[$field], $field, 1);
        }

        if ($this->user_dao->get_by_id($entity['user_id']) === null) {
            throw new ValidationException('The selected user does not exist.');
        }

        foreach (['from_level_position_id', 'to_level_position_id'] as $field) {
            if (
                $this->level_position_dao->get_by_id($entity[$field]) === null
            ) {
                throw new ValidationException(
                    'The selected ' . str_replace('_', ' ', $field) .
                    ' does not exist.'
                );
            }
        }

        if (
            (int) $entity['from_level_position_id'] ===
            (int) $entity['to_level_position_id']
        ) {
            throw new ValidationException(
                'The from and to level positions must be different.'
            );
        }

        if (
            array_key_exists('reviewed_by', $entity) &&
            $entity['reviewed_by'] !== null
        ) {
            Validator::integer($entity['reviewed_by'], 'reviewed_by', 1);

            if ($this->user_dao->get_by_id($entity['reviewed_by']) === null) {
                throw new ValidationException(
                    'The selected reviewer does not exist.'
                );
            }
        }

        if (
            array_key_exists('status', $entity) &&
            $entity['status'] !== null
        ) {
            if (!is_string($entity['status'])) {
                throw new ValidationException('Status must be text or null.');
            }

            Validator::length($entity['status'], 'status', 1, 20);
        }

        if (
            array_key_exists('reason', $entity) &&
            $entity['reason'] !== null &&
            !is_string($entity['reason'])
        ) {
            throw new ValidationException('Reason must be text or null.');
        }

        foreach (['requested_at', 'reviewed_at'] as $field) {
            if (
                array_key_exists($field, $entity) &&
                $entity[$field] !== null &&
                !is_string($entity[$field])
            ) {
                throw new ValidationException(
                    ucfirst(str_replace('_', ' ', $field)) .
                    ' must be text or null.'
                );
            }
        }
    }

    private function prepare($entity)
    {
        foreach (['status', 'reason', 'requested_at', 'reviewed_at'] as $field) {
            if (isset($entity[$field]) && is_string($entity[$field])) {
                $entity[$field] = trim($entity[$field]);
            }
        }

        return $entity;
    }
}
