<?php 
    if(isset($_GET['loggout'])) {
        Painel::loggout();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo URL_PATH?>assets/css/style.css">
    <title>Painel</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="header--logo">
                <h2 id="menu-bars"><i class="fas fa-bars"></i></h2>
            </div>
    
            <nav class="header--menu">
                <ul>
                    <li><a href="<?php echo URL_PATH_ADM?>?loggout"><i class="fas fa-sign-out"></i> Sair</a></li>
                </ul>
            </nav>

        </div><!--container-->
    </header>

    <section class="box-menu-lateral">
        <div class="lateral--header">
            <h2><?php echo $_SESSION['nome']?></h2>
        </div><!--nome-user-->
        
        <div class="lateral--menu">
            <nav>
                <ul>
                    <li <?php Painel::navCor(@$url[1], '')?> ><a href="<?php echo URL_PATH_ADM?>"><i class="fas fa-home"></i> Inicio</a></li>
                    <li <?php Painel::navCor(@$url[1], 'cadastrar-telas')?> ><a href="<?php echo URL_PATH_ADM?>cadastrar-telas"><i class="fas fa-folder-plus"></i> Cadastrar telas</a></li>
                    <li <?php Painel::navCor(@$url[1], 'gerenciar-telas')?> ><a href="<?php echo URL_PATH_ADM?>gerenciar-telas"><i class="fas fa-pen"></i> Gerenciar telas</a></li>
                </ul>
            </nav>
        </div><!--lateral--menu-->
    </section><!--menu-lateral-->

    <section class="main">
        <div class="main--content">
            <?php
                if(isset($url[1])) {

                    if($url[1] == ''){
                        include('home.php');
                    }elseif(file_exists('./assets/page/'.$url[1].'.php')) {
                        include($url[1].'.php');
                    }else {
                        Painel::redirect(URL_PATH_ADM);
                    }
                }
            ?>
        </div><!--main--content-->
    </section><!--main-->
    <?php if($url[1] == 'cadastrar-telas' || $url[1] == 'editar-tela'):?>
        <script src="<?php echo URL_PATH?>assets/js/custom.js"></script>
    <?php endif;?>
    <script src="<?php echo URL_PATH?>assets/js/script.js"></script>
</body>
</html>