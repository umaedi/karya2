<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Admin'
        ];
        return view('admin/index', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit'
        ];
        return view('admin/edit', $data);
    }

    public function password()
    {
        $data = [
            'title' => 'Ganti Password'
        ];
        return view('admin/password', $data);
    }

    //--------------------------------------------------------------------

}
