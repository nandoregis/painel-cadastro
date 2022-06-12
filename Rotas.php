<?php

    class Rotas
    {
        
        public static function rota($path, $arg) {
            $url = @$_GET['url'];

            if($url == $path) {
                $arg();
                die();
            }

            $url = explode('/', @$_GET['url']);
            $path = explode('/', $path);
            $ok = true;
            

            if(count($path) == count($url)) {
            
                foreach ($path as $key => $value) {
                    if(mb_strpos($value,'?') || mb_strpos($value,'&') ) {
                        # Significa que na class Rotas tem ?
                        echo 'path tem esses caracteres ?,&';
                    }else {
                        
                    }
                
                }
            }
            
        }

    }

?>