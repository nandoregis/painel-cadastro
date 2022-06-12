<?php
    if(isset($_GET['deletar'])) {
        $id = intval($_GET['deletar']);

        $sql = Mysql::conectar()->exec("DELETE FROM `tb_telasnetflix` WHERE id = $id");
        Painel::messageAlert('sucesso','Tela deletada com sucesso');
        Painel::redirect(URL_PATH_ADM);
    }

    if(isset($_GET['renovar'])) {
        $id = intval($_GET['renovar']);

        $data = Painel::select('tb_telasnetflix', $id);
        $dataAT = $data['data_vencimento'];
        $dataVC = Painel::dataVencimento($dataAT);

        $sql = Mysql::conectar()->prepare("UPDATE `tb_telasnetflix` SET data_ativada=?, data_vencimento=? WHERE id = ?");
        $sql->execute(array($dataAT, $dataVC, $id));
        
        Painel::messageAlert('sucesso','Tela renovada com sucesso');
        Painel::redirect(URL_PATH_ADM);
    }
?>

<div class="content w100">
    <h2>Inicio</h2>
</div><!--content-->

<div class="content w50">
    <h3>Telas que faltam 2 dias para vencimento</h3>
    <div class="tabela">
        <ul>
            <?php
                $telas = Painel::selectAll('tb_telasnetflix');
                foreach ($telas as $key => $value):
                    $dataVenc =$value['data_vencimento'];

                    $dataVenc = explode('/', $dataVenc);
                    $prazo = 2; # -> Prazo de dois dias antes do vencimento

                    $data = date('d-m-Y');
                    $data = explode('-',$data);
                   

                    if($dataVenc[1] == $data[1]) {
                        // chegou o mês de vencimento
                        
                        if( ($dataVenc[0] - $prazo)  == $data[0]) {
                           // falta dois dias para o vencimento    
            ?>
                    <li> 
                        <span><?php echo $value['email']?></span>
                        <div class="group-btn-tela">
                            <a class="btn-tela btn-green" href="<?php echo URL_PATH_ADM.'?renovar='.$value['id']?>">Renovar</a>
                            <a class="btn-tela btn-red deletar-tela" href="<?php echo URL_PATH_ADM.'?deletar='.$value['id']?>"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </li>
            <?php
                 }
                    }
                endforeach;
            ?>
        </ul>
    </div>
</div><!--content-->

<div class="content w49 mrg-left-1">
    <h3>Todas as telas</h3>
    <div class="tabela">
        <ul>
            <?php 
                $telas = Painel::selectAll('tb_telasnetflix');
                foreach ($telas as $key => $value):
            ?>
            <li> 
                <span><?php echo $value['email']?></span>
                <span>Validade: <?php echo $value['data_vencimento']?></span>
            </li>
            <?php endforeach;?>
        </ul>
    </div><!--tabela-->
</div><!--content-->
