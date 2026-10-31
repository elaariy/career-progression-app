<?php

require_once __DIR__ . '/BaseDao.php';

class LevelDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('levels', [
            'name',
            'level_code',
            'description'
        ]);
    }
}