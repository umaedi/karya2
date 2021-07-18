<?php

namespace App\Models;

use CodeIgniter\Model;

class dipinjamModel extends Model
{
    protected $table = 'dipinjam';
    protected $useTimestamps = true;

    //izinkan filed mana saja yang bisa diisi oleh user
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];
}
