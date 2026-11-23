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

    public function get_by_level_position($level_id, $position_id)
    {
        return $this->query_unique(
            'SELECT * FROM level_positions
             WHERE level_id = :level_id AND position_id = :position_id',
            [
                'level_id' => $level_id,
                'position_id' => $position_id
            ]
        );
    }
}