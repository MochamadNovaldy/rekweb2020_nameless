<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Admin extends BaseController
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
        return view('admin/product/product', $data);
    }

    public function addProduct()
    {
        // session();
        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('/admin/product/addProduct', $data);
    }

    public function saveProduct()
    {
        // validasi input
        if (!$this->validate([
            'type' => [
                'rules' => 'required|is_unique[product.type]',
                'errors' => [
                    'required' => '{field} tipe harus diisi.',
                    'is_unique' => '{field} tipe sudah terdaftar.'
                ]
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/admin/product/addProduct')->withInput();
        }

        // ambil gambar
        $fileGambar = $this->request->getFile('image');
        // apakah tidak ada gambar yang diupload
        if ($fileGambar->getError() == 4) {
            $namaGambar = 'sampul_default.jpg';
        } else {
            // generate nama sampul random
            $namaGambar = $fileGambar->getRandomName();
            // pindahkan file ke folder img
            $fileGambar->move('img', $namaGambar);
        }

        $slug = url_title($this->request->getVar('type'), '-', true);
        $this->productModel->save([
            'brand' => $this->request->getVar('brand'),
            'type' => $this->request->getVar('type'),
            'slug' => $slug,
            'price' => $this->request->getVar('price'),
            'os' => $this->request->getVar('os'),
            'storage' => $this->request->getVar('storage'),
            'cpu' => $this->request->getVar('cpu'),
            'ram' => $this->request->getVar('ram'),
            'image' => $namaGambar
        ]);

        session()->setFlashdata('pesan', 'Produk berhasil ditambahkan.');

        return redirect()->to('/admin');
    }

    public function edit($slug)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'product' => $this->productModel->getProduct($slug)
        ];

        return view('admin/product/editProduct', $data);
    }
    
    public function delete($id)
    {
        //cari berdasarkan id
        $product = $this->productModel->find($id);

        //cek jika file gambarnya default
        if ($product['image'] != 'sampul_default.jpg') {
            //hapus gambar
            unlink('img/' . $product['image']);
        }

        $this->productModel->delete($id);
        session()->setFlashdata('pesan', 'Produk berhasil dihapus');
        return redirect()->to('/admin');
    }

    public function update($id)
    {
        // cek judul
        $tipeLama = $this->productModel->getProduct($this->request->getVar('slug'));
        if ($tipeLama['type'] == $this->request->getVar('type')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[product.type]';
        }

        if (!$this->validate([
            'type' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} tipe harus diisi.',
                    'is_unique' => '{field} tipe sudah terdaftar.'
                ]
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/product/editProduct/' . $this->request->getVar('slug'))->withInput();
        }

        $fileGambar = $this->request->getFile('image');

        // cek gambar, apakah tetap gambar lama
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            // generate nama file random
            $namaGambar = $fileGambar->getRandomName();
            // pindahkan gambar
            $fileGambar->move('img', $namaGambar);
            // hapus file yang lama
            if ($this->request->getVar('gambarLama') != 'sampul_default.jpg') {
                unlink('img/' . $this->request->getVar('gambarLama'));
            }
        }

        // agar sampul_default.jpg tidak terhapus
        $slug = url_title($this->request->getVar('type'), '-', true);
        $this->productModel->save([
            'id' => $id,
            'brand' => $this->request->getVar('brand'),
            'type' => $this->request->getVar('type'),
            'slug' => $slug,
            'price' => $this->request->getVar('price'),
            'os' => $this->request->getVar('os'),
            'storage' => $this->request->getVar('storage'),
            'cpu' => $this->request->getVar('cpu'),
            'ram' => $this->request->getVar('ram'),
            'image' => $namaGambar
        ]);

        session()->setFlashdata('pesan', 'Produk berhasil diubah.');

        return redirect()->to('/admin');
    }

    public function users()
    {
        $data = [
            'product' => $this->productModel->findAll(),
        ];

        // cara connect db dengan model
        return view('admin/users/users', $data);
    }
}
