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

    public function count_by_career_type($id)
{
    $result = $this->query_unique(
        'SELECT COUNT(*) AS total FROM users WHERE career_type_id = :id',
        ['id' => $id]
    );

    return (int) $result['total'];
}
}