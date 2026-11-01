<?php

require_once __DIR__ . '/BaseDao.php';

class ResourceDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('resources', [
            'title',
            'description',
            'url'
        ]);
    }
}