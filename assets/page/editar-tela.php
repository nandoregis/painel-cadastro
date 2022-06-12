<?php
    if(isset($_GET['id'])) {
        $id = intval($_GET['id']);

        $singleTela = Painel::select('tb_telasnetflix', $id);
    }
?>
<div class="content w100">
    <h2>Editar tela</h2>
</div><!--content-->

<div class="content w100">
    <div class="register--box">
        <?php

            if(isset($_POST['acao'])) {
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $dataAtivada = $_POST['data-ativada'];

                $expressao = [
                    'nome' => '/[A-Za-z0-9\t-]{5,}/',
                    'email' => '/^[A-Za-z0-9.\-\_]{5,}@[A-Za-z0-9.\-\_]{3,}\.[a-z\.]{2,}[a-z]*$/',
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
                                
                            if($inf[1] > $mesAtual || $inf[0] > $diaMax) {
                                // Verificação para não passar mês maior e dia tambem.
                            }else {
                                // aprovado
                                $dataVencimento = Painel::dataVencimento($dataAtivada);
    
                                $sql = Mysql::conectar()->prepare("UPDATE `tb_telasnetflix` SET nome = ?, data_ativada = ?, data_vencimento = ?, email = ? WHERE id = ?");
                                $sql->execute(array($nome, $dataAtivada, $dataVencimento, $email, $id));
    
                                Painel::redirect(URL_PATH_ADM.'gerenciar-telas');
                            }
                            
                        
                        }else {
                            // data negada
                        }

                    }else {
                        // email negado
                    }
                    
                }else {
                    // nome negado
                }
            
                
            }
        
        ?>
        <form method="POST">
            <div class="el-input">
                <label for="">Nome para tela: </label>
                <input type="text" value="<?php echo $singleTela['nome']?>" name="nome" placeholder="Nome...">
            </div>
            <div class="el-input">
                <label for="">Email da tela: </label>
                <input type="email" value="<?php echo $singleTela['email']?>"  name="email" placeholder="email@email.com">
            </div>
            <div class="el-input">
                <label for="">Data de de ativação da tela: </label>
                <input class="data-input" type="text" value="<?php echo $singleTela['data_ativada']?>"  name="data-ativada" placeholder="99/99/9999" maxlength="10">
            </div>
            <input type="submit" value="Editar" name="acao">
        </form>
    </div><!--register--box-->
</div><!--content-->