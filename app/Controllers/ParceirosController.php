<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ParceirosController extends BaseController
{
    // Método index que retorna a view 'parceiros'
    public function index()
    {
        // Retorna a view 'parceiros'
        return view('parceiros');
    }
}
