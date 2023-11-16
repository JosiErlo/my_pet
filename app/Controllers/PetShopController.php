<?php

namespace App\Controllers;

class PetShopController extends BaseController
{
    // Método localizador que retorna a view 'localizador_petshops'
    public function localizador()
    {
        // Retorna a view 'localizador_petshops'
        return view('localizador_petshops');
    }
}
