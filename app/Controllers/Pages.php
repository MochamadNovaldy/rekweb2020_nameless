<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Pages extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_product') ? $this->request->getVar('page_product') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $product = $this->productModel->search($keyword);
        } else {
            $product = $this->productModel;
        }

        $data = [
            'product' => $product->paginate(3, 'admin'),
            'pager' => $this->productModel->pager,
            'currentPage' => $currentPage
        ];

        return view('pages/home', $data);
    }
}
