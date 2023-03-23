<?php
    namespace DevMacb;


    class Ambivar{
        public static function carregar($diretorio){
            if(!file_exists($diretorio . '/.env')) {
                return false;
            }

            $linhas = file($diretorio . '/.env');
            foreach($linhas as $linha) {
                putenv(trim($linha));
            }
        }
    }
?>
