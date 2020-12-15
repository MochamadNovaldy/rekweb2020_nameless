<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Product extends BaseController
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
            // 'product' => $this->productModel->findAll(),
            'product' => $product->paginate(10, 'product'),
            'pager' => $this->productModel->pager,
            'currentPage' => $currentPage
        ];

        // cara connect db dengan model
        return view('product/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'product' => $this->productModel->getProduct($slug)
        ];

        // jika produk tidak ada di tabel
        if (empty($data['product'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk ' . $slug . ' tidak ditemukan.');
        }

        return view('product/detail', $data);
    }
}
