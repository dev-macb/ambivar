<?php
    namespace DevMacb;


    class Ambivar{
        public static function carregar($diretorio) {
            if (!file_exists($diretorio . '/.env')) {
                return false;
            }

            $linhas = file($diretorio . '/.env');
            foreach($linhas as $linha) {
                putenv(trim($linha));
            }
        }

        public static function dotenv() {
            if (!file_exists(__DIR__ . '/../../../..' . '/.env')) {
                return false;
            }

            $linhas = file(__DIR__ . '/../../../..' . '/.env');
            foreach($linhas as $linha) {
                putenv(trim($linha));
            }
        }
    }
?>
