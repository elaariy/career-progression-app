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

    public function get_by_project_user($project_id, $user_id)
    {
        return $this->query_unique(
            'SELECT * FROM project_users
             WHERE project_id = :project_id AND user_id = :user_id',
            [
                'project_id' => $project_id,
                'user_id' => $user_id
            ]
        );
    }
}