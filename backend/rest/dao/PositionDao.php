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

    public function count_by_career_type($id)
{
    $result = $this->query_unique(
        'SELECT COUNT(*) AS total FROM positions WHERE career_type_id = :id',
        ['id' => $id]
    );

    return (int) $result['total'];
}
}