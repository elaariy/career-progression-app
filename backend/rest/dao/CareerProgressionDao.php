<?php

require_once __DIR__ . '/BaseDao.php';

class CareerProgressionDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('career_progressions', [
            'user_id',
            'level_position_id',
            'start_date',
            'end_date',
            'notes'
        ]);
    }
}