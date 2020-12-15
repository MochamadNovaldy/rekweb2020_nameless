<?php

namespace App\Models;

use CodeIgniter\Model;

class PagesModel extends Model
{
    protected $table = 'product';
    protected $allowedFields = ['brand', 'type', 'slug', 'price', 'os', 'storage', 'cpu', 'ram', 'image'];

    public function getPages($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
