<div class="content w100">
    <h2>Cadastrar telas</h2>
</div><!--content-->

<div class="content w100">
    <div class="register--box">
        <form method="POST">
            <?php 
            
                $nome = '';
                $email = '';
                $dataAtivada = '';

                if(isset($_POST['acao'])) {
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $dataAtivada = $_POST['data-ativada'];

                    $expressao = [
                        'nome' => '/[A-Za-z0-9\t-\+]{5,}/',
                        'email' => '/^[A-Za-z0-9.\-\_#\+]{5,}@[A-Za-z0-9.\-\_]{3,}\.[a-z\.]{2,}[a-z]*$/',
                        'data' => '/^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{4,4}$/'
                    ];

                    if(Painel::validarForm($expressao['nome'], $nome) ) {
                    
                        if(Painel::validarForm($expressao['email'], $email)) {
                            
                            if(Painel::validarForm($expressao['data'], $dataAtivada)) {
                                // todos os campos estão corretos...
                                $inf = explode('/',$dataAtivada);
                                $diaMax = date('t');
                                $mesAtual = date('m');
                                $anoAtual = date('Y');
                                
                                if($inf[1] > $mesAtual || $inf[0] > $diaMax || $inf[2] != $anoAtual) {
                                    // Verificação para não passar mês maior e dia tambem.
                                    Painel::messageAlert('erro', 'Escolha uma data real dia, mês e ano');
                                    
                                }else {
                                    $dataVencimento = Painel::dataVencimento($dataAtivada);
    
                                    $sql = Mysql::conectar()->prepare("INSERT INTO `tb_telasnetflix` VALUES(null, ?,?,?,?)");
                                    $sql->execute(array($nome, $dataAtivada, $dataVencimento, $email));
    
                                    $nome = '';
                                    $email = '';
                                    $dataAtivada = '';
                                }
                                
                            }else {
                                // data negada
                                Painel::messageAlert('erro', 'Escolha um data real');
                            }

                        }else {
                            // email negado
                            Painel::messageAlert('erro', 'Email pode está incorreto');
                        }
                        
                    }else {
                        // nome negado
                        Painel::messageAlert('erro', 'Esse nome não foi aceito');
                    }
                
                    
                }
            
            ?>
            <div class="el-input">
                <label for="">Nome para tela: </label>
                <input type="text" value="<?php echo $nome?>" name="nome" placeholder="Nome...">
            </div>
            <div class="el-input">
                <label for="">Email da tela: </label>
                <input type="email" value="<?php echo $email?>"  name="email" placeholder="email@email.com">
            </div>
            <div class="el-input">
                <label for="">Data de de ativação da tela: </label>
                <input class="data-input" type="text" value="<?php echo $dataAtivada?>"  name="data-ativada" placeholder="99/99/9999" maxlength="10">
            </div>
            <input type="submit" value="Cadastrar" name="acao">
        </form>
    </div><!--register--box-->
</div><!--content-->