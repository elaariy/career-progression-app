<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/ProgressionCommentDao.php';
require_once __DIR__ . '/../dao/ProgressionRequestDao.php';
require_once __DIR__ . '/../dao/UserDao.php';

class ProgressionCommentService extends BaseService
{
    protected $entity_name = 'Progression comment';
    private $progression_request_dao;
    private $user_dao;

    public function __construct()
    {
        parent::__construct(new ProgressionCommentDao());
        $this->progression_request_dao = new ProgressionRequestDao();
        $this->user_dao = new UserDao();
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
        if (isset($entity['comment']) && !is_string($entity['comment'])) {
            throw new ValidationException('Comment must be text.');
        }

        Validator::required(
            $entity,
            ['progression_request_id', 'user_id', 'comment']
        );
        Validator::integer(
            $entity['progression_request_id'],
            'progression_request_id',
            1
        );
        Validator::integer($entity['user_id'], 'user_id', 1);

        if (
            $this->progression_request_dao->get_by_id(
                $entity['progression_request_id']
            ) === null
        ) {
            throw new ValidationException(
                'The selected progression request does not exist.'
            );
        }

        if ($this->user_dao->get_by_id($entity['user_id']) === null) {
            throw new ValidationException('The selected user does not exist.');
        }
    }

    private function prepare($entity)
    {
        if (isset($entity['comment']) && is_string($entity['comment'])) {
            $entity['comment'] = trim($entity['comment']);
        }

        return $entity;
    }
}
