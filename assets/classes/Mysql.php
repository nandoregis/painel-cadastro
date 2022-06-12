<?php


    class Mysql
    {
        private static $pdo;
        public static function conectar() {
            
            try{

                if(self::$pdo == null) {
                    self::$pdo = new PDO("mysql:host=".HOST.";dbname=".DB_NAME,ROOT,PASSWORD);
                }
                
            }catch(Exception $e) {
                die('Erro de conexão!');
            }

            return self::$pdo;
        }

    }

?>