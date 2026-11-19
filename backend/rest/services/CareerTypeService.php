<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/CareerTypeDao.php';

require_once __DIR__ . '/../dao/PositionDao.php';
require_once __DIR__ . '/../dao/UserDao.php';

class CareerTypeService extends BaseService
{
    protected $entity_name = 'Career type';

    public function __construct()
    {
        parent::__construct(new CareerTypeDao());
    }

    public function add($entity)
    {
        return parent::add($this->prepare($entity));
    }

    public function update($entity, $id)
    {
        return parent::update($this->prepare($entity), $id);
    }

    public function delete($id)
    {
    $this->get_by_id($id);

    $positionDao = new PositionDao();
    $userDao = new UserDao();

    $positions = $positionDao->count_by_career_type($id);
    $users = $userDao->count_by_career_type($id);

    if ($positions > 0 || $users > 0) {
        throw new ValidationException(
            'This career type is still in use and cannot be deleted.'
        );
    }

    $this->dao->delete($id);
    }

    protected function validate($entity, $id = null)
    {
        if (isset($entity['name']) && !is_string($entity['name'])) {
            throw new ValidationException('Career type name must be text.');
        }

        Validator::required($entity, ['name']);
        Validator::length($entity['name'], 'name', 1, 100);

        if (isset($entity['description']) && !is_string($entity['description'])) {
            throw new ValidationException('Description must be text.');
        }
    }

    private function prepare($entity)
    {
        if (isset($entity['name']) && is_string($entity['name'])) {
            $entity['name'] = trim($entity['name']);
        }

        if (isset($entity['description']) && is_string($entity['description'])) {
            $entity['description'] = trim($entity['description']);
        }

        return $entity;
    }
}