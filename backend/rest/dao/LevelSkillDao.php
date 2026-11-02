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
}