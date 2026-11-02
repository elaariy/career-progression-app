<?php

require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('users', [
            'role_id',
            'career_type_id',
            'current_level_position_id',
            'first_name',
            'last_name',
            'email',
            'password_hash',
            'experience_years',
            'is_active'
        ]);
    }
}