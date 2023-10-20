<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class LanguageController extends BaseController
{
    public function setLanguage(){

        $locale = $this->request->uri->getSegment(2);
        $supportedLanguages = ['en', 'pt-BR'];

        if(in_array($locale, $supportedLanguages)){
            session()->set('user_locale', $locale);
        }

        if(session()->has('user_locale')){
            $this->request->setLocale(session('user_locale'));
        }else{
            $this->request->setLocale('en');
        }
    
        return redirect()->back();
    }
}
