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

    public function get_by_name($name)
    {
        return $this->query_unique(
            'SELECT * FROM levels WHERE name = :name',
            ['name' => $name]
        );
    }

    public function get_by_level_code($level_code)
    {
        return $this->query_unique(
            'SELECT * FROM levels WHERE level_code = :level_code',
            ['level_code' => $level_code]
        );
    }
}