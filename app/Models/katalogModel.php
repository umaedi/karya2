<?php

namespace App\Models;

use CodeIgniter\Model;

class katalogModel extends Model
{
    protected $table = 'katalog_buku';
    protected $useTimestamps = true;

    //izinkan filed mana saja yang bisa diisi oleh user
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];

    public function getkatalog($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
