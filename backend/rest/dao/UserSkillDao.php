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

    public function get_by_user_skill($user_id, $skill_id)
    {
        return $this->query_unique(
            'SELECT * FROM user_skills
             WHERE user_id = :user_id AND skill_id = :skill_id',
            [
                'user_id' => $user_id,
                'skill_id' => $skill_id
            ]
        );
    }
}