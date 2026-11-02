<?php

require_once __DIR__ . '/BaseDao.php';

class SkillDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('skills', [
            'name',
            'description'
        ]);
    }
}