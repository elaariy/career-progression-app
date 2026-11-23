<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/ProjectDao.php';

class ProjectService extends BaseService
{
    protected $entity_name = 'Project';

    public function __construct()
    {
        parent::__construct(new ProjectDao());
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
            throw new ValidationException('Project name must be text.');
        }

        Validator::required($entity, ['name']);
        Validator::length($entity['name'], 'name', 1, 200);

        if (
            array_key_exists('description', $entity) &&
            $entity['description'] !== null &&
            !is_string($entity['description'])
        ) {
            throw new ValidationException(
                'Description must be text or null.'
            );
        }

        foreach (['start_date', 'end_date'] as $field) {
            if (array_key_exists($field, $entity) && $entity[$field] !== null) {
                Validator::date($entity[$field], $field);
            }
        }

        if (
            isset($entity['start_date'], $entity['end_date']) &&
            $entity['end_date'] < $entity['start_date']
        ) {
            throw new ValidationException(
                'End date cannot be before start date.'
            );
        }

        if (array_key_exists('status', $entity)) {
            if (!is_string($entity['status'])) {
                throw new ValidationException('Project status must be text.');
            }

            Validator::length($entity['status'], 'status', 1, 30);
        }
    }

    private function prepare($entity)
    {
        foreach (
            ['name', 'description', 'start_date', 'end_date', 'status']
            as $field
        ) {
            if (isset($entity[$field]) && is_string($entity[$field])) {
                $entity[$field] = trim($entity[$field]);
            }
        }

        foreach (['start_date', 'end_date'] as $field) {
            if (array_key_exists($field, $entity) && $entity[$field] === '') {
                $entity[$field] = null;
            }
        }

        return $entity;
    }
}
