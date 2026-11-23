<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/CareerTypeDao.php';
require_once __DIR__ . '/../dao/LevelPositionDao.php';

class UserService extends BaseService
{
    protected $entity_name = 'User';
    private $role_dao;
    private $career_type_dao;
    private $level_position_dao;

    public function __construct()
    {
        parent::__construct(new UserDao());
        $this->role_dao = new RoleDao();
        $this->career_type_dao = new CareerTypeDao();
        $this->level_position_dao = new LevelPositionDao();
    }

    public function get_all()
    {
        $users = $this->dao->get_all();

        foreach ($users as &$user) {
            $user = $this->remove_password_fields($user);
        }
        unset($user);

        return $users;
    }

    public function get_by_id($id)
    {
        return $this->remove_password_fields(parent::get_by_id($id));
    }

    public function add($entity)
    {
        $entity = $this->prepare($entity);

        if (isset($entity['password']) && is_string($entity['password'])) {
            $entity['password_hash'] = password_hash(
                $entity['password'],
                PASSWORD_DEFAULT
            );
        }

        try {
            $user = parent::add($entity);
        } catch (PDOException $e) {
            $this->throw_user_constraint_exception($e);
        }

        return $this->remove_password_fields($user);
    }

    public function update($entity, $id)
    {
        $entity = $this->prepare($entity);

        if (isset($entity['password']) && is_string($entity['password'])) {
            $entity['password_hash'] = password_hash(
                $entity['password'],
                PASSWORD_DEFAULT
            );
        }

        try {
            $user = parent::update($entity, $id);
        } catch (PDOException $e) {
            $this->throw_user_constraint_exception($e);
        }

        return $this->remove_password_fields($user);
    }

    protected function validate($entity, $id = null)
    {
        foreach (['first_name', 'last_name', 'email'] as $field) {
            if (isset($entity[$field]) && !is_string($entity[$field])) {
                throw new ValidationException(
                    ucfirst(str_replace('_', ' ', $field)) . ' must be text.'
                );
            }
        }

        Validator::required(
            $entity,
            ['role_id', 'first_name', 'last_name', 'email']
        );
        Validator::integer($entity['role_id'], 'role_id', 1);
        Validator::length($entity['first_name'], 'first_name', 1, 100);
        Validator::length($entity['last_name'], 'last_name', 1, 100);
        Validator::length($entity['email'], 'email', 1, 255);
        Validator::is_email($entity['email']);

        if ($this->role_dao->get_by_id($entity['role_id']) === null) {
            throw new ValidationException('The selected role does not exist.');
        }

        $optionalReferences = [
            'career_type_id' => [
                'dao' => $this->career_type_dao,
                'message' => 'The selected career type does not exist.'
            ],
            'current_level_position_id' => [
                'dao' => $this->level_position_dao,
                'message' => 'The selected level position does not exist.'
            ]
        ];

        foreach ($optionalReferences as $field => $reference) {
            if (array_key_exists($field, $entity) && $entity[$field] !== null) {
                Validator::integer($entity[$field], $field, 1);

                if ($reference['dao']->get_by_id($entity[$field]) === null) {
                    throw new ValidationException($reference['message']);
                }
            }
        }

        if (
            array_key_exists('experience_years', $entity) &&
            $entity['experience_years'] !== null
        ) {
            Validator::integer($entity['experience_years'], 'experience_years');
        }

        if (
            array_key_exists('is_active', $entity) &&
            $entity['is_active'] !== null &&
            !is_bool($entity['is_active']) &&
            !in_array($entity['is_active'], [0, 1, '0', '1'], true)
        ) {
            throw new ValidationException(
                'is_active must be a boolean or null.'
            );
        }

        if (!array_key_exists('password', $entity)) {
            if ($id === null) {
                throw new ValidationException('Password is required.');
            }
        } else {
            if (!is_string($entity['password'])) {
                throw new ValidationException('Password must be text.');
            }

            if (trim($entity['password']) === '') {
                throw new ValidationException(
                    'Password must not be blank.'
                );
            }
        }

        $existing = $this->dao->get_by_email($entity['email']);
        if ($existing && (int) $existing['id'] !== (int) $id) {
            throw new ValidationException(
                'A user with this email address already exists.'
            );
        }
    }

    private function prepare($entity)
    {
        unset($entity['password_hash']);

        foreach (['first_name', 'last_name', 'email'] as $field) {
            if (isset($entity[$field]) && is_string($entity[$field])) {
                $entity[$field] = trim($entity[$field]);
            }
        }

        return $entity;
    }

    private function remove_password_fields($user)
    {
        unset($user['password'], $user['password_hash']);

        return $user;
    }

    private function throw_user_constraint_exception(PDOException $exception)
    {
        $mysqlError = (int) ($exception->errorInfo[1] ?? 0);

        if ($mysqlError === 1062) {
            throw new ValidationException(
                'A user with this email address already exists.'
            );
        }

        if ($mysqlError === 1452) {
            throw new ValidationException(
                'A referenced user value does not exist.'
            );
        }

        throw $exception;
    }
}
