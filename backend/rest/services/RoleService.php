<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/RoleDao.php';

class RoleService extends BaseService
{
    protected $entity_name = 'Role';

    public function __construct()
    {
        parent::__construct(new RoleDao());
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
            throw new ValidationException('Role name must be text.');
        }

        Validator::required($entity, ['name']);
        Validator::length($entity['name'], 'name', 1, 50);

        if (
            array_key_exists('description', $entity) &&
            $entity['description'] !== null
        ) {
            if (!is_string($entity['description'])) {
                throw new ValidationException(
                    'Description must be text or null.'
                );
            }

            Validator::length(
                $entity['description'],
                'description',
                0,
                255
            );
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
