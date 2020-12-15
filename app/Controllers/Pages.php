<?php

namespace App\Controllers;

use App\Models\PagesModel;

class Pages extends BaseController
{
    protected $pagesModel;

    public function __construct()
    {
        $this->pagesModel = new PagesModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_home') ? $this->request->getVar('page_home') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pages = $this->pagesModel->search($keyword);
        } else {
            $pages = $this->pagesModel;
        }

        $data = [
            'pages' => $pages->paginate(3, 'admin'),
            'pager' => $this->pagesModel->pager,
            'currentPage' => $currentPage
        ];

        return view('pages/home', $data);
    }
}
