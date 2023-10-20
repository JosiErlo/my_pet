<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function dashboard()
    {
        // Sua lógica para a página de dashboard aqui
        return view('admin/dashboard'); // Exemplo: retornar a view 'admin/dashboard'
    }
}
