<?php

    class Painel 
    {
        // função de login do painel
        public static function logado() {
            return isset($_SESSION['logado-painel']) ? true : false;
        }
        
        // função para selecionar todos os elementos 
        public static function selectAll($table) {
            $sql = Mysql::conectar()->prepare("SELECT * FROM `$table`");
            $sql->execute();
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $sql;
            
        }

        // função para selecionar elemento unico
        public static function select($table, $id) {
            $sql = Mysql::conectar()->prepare("SELECT * FROM `$table` WHERE id = ? ");
            $sql->execute(array( $id));
            
            if($sql->rowCount() == 1) {
                $sql = $sql->fetch(PDO::FETCH_ASSOC);
                return $sql;
            }else {
                return false;
            }
        }

        // função para redirecionamento
        public static function redirect($url) {
            echo "<script> location.href = '$url' ;</script>";
            die();
            
        }

        // função para mudar cor de navegação lateral do painel
        public static function navCor($url, $par) {
            if($url == $par) {
                echo 'class="nav-active"';
            }
        }

        // função para sair do painel
        public static function loggout() {
            session_destroy();
            Painel::redirect(URL_PATH);
        }

        // function para validar formulario de cadastro de tela e upload
        public static function validarForm($express, $campo) {
            if(preg_match($express, $campo)) {
                return true;
            }else {
                return false;
            }
        }

        // Função para criar data de vencimento da tela
        public static function dataVencimento($dataAtivacao) {
            $dataVenc = explode('/', $dataAtivacao);

            $dataVenc[1] = $dataVenc[1] + 1;

            if($dataVenc[1] < 10) {
                $dataVenc[1] = '0'.$dataVenc[1];
            }
            
            if($dataVenc[1] == 13) {
                $dataVenc[2] = $dataVenc[2] + 1;
                $dataVenc[1] = 1;
                if($dataVenc[1] < 10) {
                    $dataVenc[1] = '0'.$dataVenc[1];
                }
            }

            $dataVenc = implode('/',$dataVenc);
            
            return $dataVenc;
        }

        public static function messageAlert($val, $message) {
            if($val == 'sucesso'){
                echo "
                    <div class='message message-success'>
                        <p>$message</p>
                    </div><!--box-message-->
                ";
            }else {
                echo "
                    <div class='message message-error'>
                        <p>$message</p>
                    </div><!--box-message-->
                 ";
            }
        }

    } # classe


?>