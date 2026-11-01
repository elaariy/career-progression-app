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
}