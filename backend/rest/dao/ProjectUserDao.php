<?php

require_once __DIR__ . '/BaseDao.php';

class ProjectUserDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('project_users', [
            'project_id',
            'user_id',
            'joined_at'
        ]);
    }
}