<?php

namespace App\Controllers;

use App\Models\memberModel;

class Member extends BaseController
{
    protected $memberModel;
    public function __construct()
    {
        $this->memberModel = new memberModel();
    }
    public function index()
    {
        $curentPage = $this->request->getVar('page_member') ? $this->request->getVar('page_member') : 1;

        //tampilkan data  berdsarkan hasil pencarian
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $member = $this->memberModel->search($keyword);
        } else {
            $member = $this->memberModel;
        }
        $data = [
            'title' => 'Member',
            'member' => $member->paginate(10, 'member'),
            'pager' => $this->memberModel->pager,
            'curentPage' => $curentPage
        ];
        return view('member/member.php', $data);
    }

    //--------------------------------------------------------------------

}
