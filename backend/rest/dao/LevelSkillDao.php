<?php

require_once __DIR__ . '/BaseDao.php';

class LevelSkillDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('level_skills', [
            'level_id',
            'skill_id'
        ]);
    }

    public function get_by_level_skill($level_id, $skill_id)
    {
        return $this->query_unique(
            'SELECT * FROM level_skills
             WHERE level_id = :level_id AND skill_id = :skill_id',
            [
                'level_id' => $level_id,
                'skill_id' => $skill_id
            ]
        );
    }
}