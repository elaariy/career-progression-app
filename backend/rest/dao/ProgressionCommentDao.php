<?php

require_once __DIR__ . '/BaseDao.php';

class ProgressionCommentDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('progression_comments', [
            'progression_request_id',
            'user_id',
            'comment'
        ]);
    }
}