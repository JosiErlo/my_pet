<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PostModel;

class HomeController extends Controller
{
    public function index()
    {
        $postModel = new PostModel();

        // Verifique se uma categoria foi filtrada
        $selectedCategory = $this->request->getGet('category');

        if ($selectedCategory && $selectedCategory !== 'all') {
            $data['posts'] = $postModel->findByCategory($selectedCategory);
        } else {
            $data['posts'] = $postModel->findAll();
        }

        $data['selectedCategory'] = $selectedCategory;
        return view('index', $data);
    }
}
