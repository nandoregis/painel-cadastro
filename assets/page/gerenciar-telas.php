<?php
    if(isset($_GET['deletar'])) {
        $id = intval($_GET['deletar']);

        $sql = Mysql::conectar()->exec("DELETE FROM `tb_telasnetflix` WHERE id = $id");
        Painel::redirect(URL_PATH_ADM.'gerenciar-telas');
    }
?>
<div class="content w100">
    <h2>Gerenciar telas</h2>
    <div class="tabela">
        <ul>
            <?php 
                $telas = Painel::selectAll('tb_telasnetflix');
                foreach ($telas as $key => $value):
            ?>
            <li> 
                <span><?php echo $value['email']?></span>
                <div class="group-btn-tela">
                    <a class="btn-tela btn-orange" href="<?php echo URL_PATH_ADM.'editar-tela?id='.$value['id']?>">Editar</a>
                    <a class="btn-tela btn-red deletar-tela" href="<?php echo URL_PATH_ADM.'gerenciar-telas?deletar='.$value['id']?>">Deletar</a>
                </div>
            </li>
            <?php endforeach;?>
        </ul>
    </div><!--tabela-->
</div><!--content-->