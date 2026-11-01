<?php

require_once __DIR__ . '/BaseDao.php';

class Project extends BaseDao
{
    public function __construct()
    {
        parent::__construct('projects', [
            'name',
            'description',
            'start_date',
            'end_date',
            'status'
        ])
    }
}