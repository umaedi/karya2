<?php

namespace App\Models;

use CodeIgniter\Model;

class memberModel extends Model
{
    protected $table = 'member';
    protected $useTimestamps = true;

    protected $allowedFields = ['name', 'email'];

    public function search($keyword)
    {
        $builder = $this->table('member');
        $builder->like('name', $keyword);
        return $builder;
    }
}
