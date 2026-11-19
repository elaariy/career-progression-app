<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/PositionDao.php';
require_once __DIR__ . '/../dao/CareerTypeDao.php';

class PositionService extends BaseService
{
    protected $entity_name = 'Position';
    private $career_type_dao;

    public function __construct()
    {
        parent::__construct(new PositionDao());
        $this->career_type_dao = new CareerTypeDao();
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
        if (isset($entity['name']) && !is_string($entity['name'])) {
            throw new ValidationException('Position name must be text.');
        }

        Validator::required($entity, ['name']);
        Validator::length($entity['name'], 'name', 1, 100);
        Validator::integer(
            $entity['career_type_id'] ?? null,
            'career_type_id',
            1
        );

        if ($this->career_type_dao->get_by_id($entity['career_type_id']) === null) {
            throw new ValidationException(
                'The selected career type does not exist.'
            );
        }

        if (
            array_key_exists('description', $entity) &&
            $entity['description'] !== null &&
            !is_string($entity['description'])
        ) {
            throw new ValidationException('Description must be text or null.');
        }
    }

    private function prepare($entity)
    {
        if (isset($entity['name']) && is_string($entity['name'])) {
            $entity['name'] = trim($entity['name']);
        }

        if (
            isset($entity['description']) &&
            is_string($entity['description'])
        ) {
            $entity['description'] = trim($entity['description']);
        }

        return $entity;
    }
}
