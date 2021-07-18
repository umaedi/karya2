<?php

namespace App\Controllers;

use App\Models\katalogModel;
use App\Models\memberModel;
use App\Models\dipinjamModel;

class Home extends BaseController
{
    protected $katalogModel;
    protected $memberModel;
    protected $dipinjamModel;
    public function __construct()
    {
        $this->katalogModel = new katalogModel();
        $this->memberModel = new memberModel();
        $this->dipinjamModel = new dipinjamModel();
    }
    public function index()
    {
        $jumlahBuku = $this->katalogModel->countAllResults();
        $bukuDipinjam = $this->dipinjamModel->countAllResults();
        $member = $this->memberModel->countAllResults();

        $data = [
            'title' => 'Home | E-Library',
            'jumlahBuku' => $jumlahBuku - $bukuDipinjam,
            'member' => $member
        ];

        return view('home/index', $data);
    }

    //--------------------------------------------------------------------

}
