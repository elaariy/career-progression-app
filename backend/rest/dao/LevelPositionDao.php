<?php

require_once __DIR__ . '/BaseDao.php';

class LevelPositionDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('level_positions', [
            'level_id',
            'position_id'
        ]);
    }
}