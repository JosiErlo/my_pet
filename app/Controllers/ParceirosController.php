<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ParceirosController extends BaseController
{
    public function index()
    {
        return view('parceiros');
    }
}
