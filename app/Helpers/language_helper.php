<?php

if(!function_exists('getPreferredLanguage')){
    function getPreferredLanguage(array $supportedLanguages, $default = 'pt-BR'){

        
        if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
            $languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
            foreach ($languages as $lang) {
                $lang = substr($lang, 0, 5);
   
                if(in_array($lang, $supportedLanguages)){
                    return $lang;
                }
            }
        }
        return $default;
    }
}