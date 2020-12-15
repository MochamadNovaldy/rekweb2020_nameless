<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_admin') ? $this->request->getVar('page_admin') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $admin = $this->adminModel->search($keyword);
        } else {
            $admin = $this->adminModel;
        }

        $data = [
            'admin' => $admin->paginate(10, 'admin'),
            'pager' => $this->adminModel->pager,
            'currentPage' => $currentPage
        ];

        // cara connect db dengan model
        return view('admin/index', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('admin/create', $data);
    }

    public function save()
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
            return redirect()->to('/admin/create')->withInput();
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
        $this->adminModel->save([
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

    public function delete($id)
    {
        // cari berdasarkan id
        $admin = $this->adminModel->find($id);

        // cek jika file gambarnya default
        if ($admin['image'] != 'sampul_default.jpg') {
            // hapus gambar
            unlink('img/' . $admin['image']);
        }

        $this->adminModel->delete($id);
        session()->setFlashdata('pesan', 'Produk berhasil dihapus.');
        return redirect()->to('/admin');
    }

    public function edit($slug)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'admin' => $this->adminModel->getAdmin($slug)
        ];

        return view('admin/edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $tipeLama = $this->adminModel->getAdmin($this->request->getVar('slug'));
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
            return redirect()->to('/admin/edit/' . $this->request->getVar('slug'))->withInput();
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
        $this->adminModel->save([
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
}
