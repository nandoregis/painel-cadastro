
<?php
    // header('Content-Type: Application-json');
    /*
        TODO: fazer a parte de rotas de usuarios ...
          - mostrar todos os usuarios
          - buscar o usuario pelo id_tela para mostra que usuarios usam a telas.
    */
    include('config.php');

    $url = isset($_GET['url']) ? $_GET['url'] : "";
    $url = explode('/', @$_GET['url']);


    if($url[0]  === 'api') {

        # - busca todas as telas existente no banco de dados
        Rotas::rota('api/all/tela', function() {    
            $data = Painel::selectAll('tb_telasnetflix');
            $arr = ['status' => 'success', 'data' => $data];
            echo json_encode($arr);
        });
        
        # -> rotas expecifica - buscar item expecifico.
        Rotas::rota('api/a/tela', function() {
            if(isset($_GET['id'])) {
                $id = intval($_GET['id']);
                
                $data = Painel::select('tb_telasnetflix', $id);
                if($data) {
                    $arr = ['status' => 'success', 'data' => $data];
                }else {
                    $arr = ['status' => 'error', 'data' => $data];
                }
                echo json_encode($arr);
            }
    
        });

        Rotas::rota('api/all/user', function() {
            $data = Painel::selectAll('tb_usuarios');
            $arr = ['status' => 'success', 'data' => $data];
            echo json_encode($arr);
        });

    }else if(file_exists('./assets/page/'.$url[0].'.php')){
        if(isset($_SESSION['logado-painel'])) {
            include('./assets/page/admin.php');
        }else {
            Painel::redirect(URL_PATH);
        }
    }else {

        if($url[0] === '') {
            // vazio

            if(!isset($_SESSION['logado-painel'])) {
                include('./assets/page/login.php');
            }else {
                Painel::redirect(URL_PATH_ADM);
            }
        }else {
            Painel::redirect(URL_PATH);
        }

    }


?>



