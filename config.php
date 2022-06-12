<?php
    session_start();
    include('Rotas.php');
        
    $autoload = function($class) {
        include("./assets/classes/$class.php");
    };
    spl_autoload_register($autoload);


    define('URL_PATH', 'http://localhost/Novos%20Projetos/projeto-rafael/');
    define('URL_PATH_ADM', URL_PATH.'admin/');

    /* ACESSO A O BANCO */

    define('HOST', 'localhost');
    define('DB_NAME','proj_rafael');
    define('ROOT','root');
    define('PASSWORD','');
?>