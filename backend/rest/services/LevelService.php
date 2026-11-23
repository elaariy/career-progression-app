<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/LevelDao.php';

class LevelService extends BaseService
{
    protected $entity_name = 'Level';

    public function __construct()
    {
        parent::__construct(new LevelDao());
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
            throw new ValidationException('Level name must be text.');
        }

        if (
            isset($entity['level_code']) &&
            !is_string($entity['level_code'])
        ) {
            throw new ValidationException('Level code must be text.');
        }

        Validator::required($entity, ['name', 'level_code']);
        Validator::length($entity['name'], 'name', 1, 50);
        Validator::length($entity['level_code'], 'level_code', 1, 10);

        if (
            array_key_exists('description', $entity) &&
            $entity['description'] !== null &&
            !is_string($entity['description'])
        ) {
            throw new ValidationException(
                'Description must be text or null.'
            );
        }

        $existingName = $this->dao->get_by_name($entity['name']);
        if ($existingName && (int) $existingName['id'] !== (int) $id) {
            throw new ValidationException(
                "A level named '{$entity['name']}' already exists."
            );
        }

        $existingCode = $this->dao->get_by_level_code($entity['level_code']);
        if ($existingCode && (int) $existingCode['id'] !== (int) $id) {
            throw new ValidationException(
                "A level with code '{$entity['level_code']}' already exists."
            );
        }
    }

    private function prepare($entity)
    {
        foreach (['name', 'level_code', 'description'] as $field) {
            if (isset($entity[$field]) && is_string($entity[$field])) {
                $entity[$field] = trim($entity[$field]);
            }
        }

        return $entity;
    }
}
