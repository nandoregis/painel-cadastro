<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo URL_PATH?>assets/css/style.css">
    <title>Login</title>
</head>
<body class="login-body">
    <section class="box-login">
        <div class="login">
            <h2>Efetuar Login:</h2>
            <form method="POST">
                <?php
                    if(isset($_POST['acao'])) {
                       
                        $user = $_POST['usuario'];
                        $pass = $_POST['senha'];

                        $sql = Mysql::conectar()->prepare("SELECT * FROM `tb_login` WHERE usuario = ? AND senha = ? ");
                        $sql->execute(array($user, $pass) );

                        if($sql->rowCount() == 1) {
                            $info = $sql->fetch();
                            $_SESSION['logado-painel'] = true;
                            $_SESSION['nome'] = $info['nome'];
                            $_SESSION['usuario'] = $info['usuario'];
                            $_SESSION['senha'] = $info['senha'];
                            Painel::redirect(URL_PATH_ADM);

                        }else {
                            
                        }
                    }
                ?>
                <label for="">Usuario: </label>
                <input type="text" name="usuario" placeholder="inserir nome...">
                <label for="">Senha: </label>
                <input type="password" name="senha" placeholder="inserir senha...">
                <input type="submit" value="Login" name="acao">
            </form>
        </div>    
    </section>

</body>
</html>