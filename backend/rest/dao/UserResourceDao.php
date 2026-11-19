<?php

require_once __DIR__ . '/BaseDao.php';

class UserResourceDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('user_resources', [
            'user_id',
            'resource_id',
            'saved_at'
        ]);
    }

    public function get_by_user_resource($user_id, $resource_id)
    {
        return $this->query_unique(
            'SELECT * FROM user_resources
             WHERE user_id = :user_id AND resource_id = :resource_id',
            [
                'user_id' => $user_id,
                'resource_id' => $resource_id
            ]
        );
    }
}