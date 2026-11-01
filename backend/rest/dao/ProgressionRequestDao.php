<?php

require_once __DIR__ . '/BaseDao.php';

class ProgressionRequestDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('progression_requests', [
            'user_id',
            'from_level_position_id',
            'to_level_position_id',
            'status',
            'reason',
            'requested_at',
            'reviewed_at',
            'reviewed_by'
        ]);
    }
}