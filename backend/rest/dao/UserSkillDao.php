<?php

require_once __DIR__ . '/BaseDao.php';

class UserSkillDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('user_skills', [
            'user_id',
            'skill_id',
            'progress_percent',
            'is_completed',
            'last_updated_at'
        ]);
    }
}