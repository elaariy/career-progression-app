<?php

require_once __DIR__ . '/BaseDao.php';

class PositionDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct(
            'positions',
            ['career_type_id', 'name', 'description']
        );
    }
}