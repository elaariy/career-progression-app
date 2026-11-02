<?php

require_once __DIR__ . '/BaseDao.php';

class CareerTypeDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('career_types', ['name', 'description']);
    }
}