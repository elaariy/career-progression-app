<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/SkillDao.php';

class SkillService extends BaseService
{
    protected $entity_name = 'Skill';

    public function __construct()
    {
        parent::__construct(new SkillDao());
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
            throw new ValidationException('Skill name must be text.');
        }

        Validator::required($entity, ['name']);
        Validator::length($entity['name'], 'name', 1, 150);

        if (isset($entity['description']) && !is_string($entity['description'])) {
            throw new ValidationException('Description must be text.');
        }
    }

    private function prepare($entity)
    {
        if (isset($entity['name']) && is_string($entity['name'])) {
            $entity['name'] = trim($entity['name']);
        }

        $entity['description'] = $entity['description'] ?? null;

        if (is_string($entity['description'])) {
            $entity['description'] = trim($entity['description']);
        }

        return $entity;
    }
}