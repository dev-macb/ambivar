<?php
    namespace DevMacb;


    class Ambivar {
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


        public static function escrever_env($diretorio, $chave, $valor) {
            $conteudo_env = file_get_contents($diretorio . '/.env');
            $nova_env = "\n{$chave}={$valor}";
            file_put_contents($diretorio . '/.env', $conteudo_env . $nova_env, FILE_APPEND);
        }


        public static function apagar_env($diretorio, $chave) {
            $conteudo_env = file_get_contents($diretorio . '/.env');
            $padrao_env = "/^{strtoupper($chave)}=.*/m";
            $env_apagada = preg_replace($padrao_env, '', $conteudo_env);
            file_put_contents($diretorio . '/.env', $env_apagada);
        }
    }
?>
