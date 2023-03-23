<?php
    namespace DevMacb;


    class Ambivar {
        public static function dotenv() {
            if (!file_exists(__DIR__ . '/../../../..' . '/.env')) {
                return false;
            }
            $linhas = file(__DIR__ . '/../../../..' . '/.env');
            foreach($linhas as $linha) {
                if ($linha != "\n") {
                    putenv(trim($linha));
                }
            }
            $arquivos = glob(__DIR__ . '/../../../..' . '/*.env');
            foreach($arquivos as $arquivo) {
                $linhas = file($arquivo);
                foreach($linhas as $linha) {
                    if ($linha != "\n") {
                        putenv(trim($linha));
                    }
                }
            }
        }


        public static function carregar($diretorio, $arquivo='') {
            if (!file_exists($diretorio . '/' . $arquivo . '.env')) {
                return false;
            }
            $linhas = file($diretorio . '/' . $arquivo . '.env');
            foreach($linhas as $linha) {
                if ($linha != "\n") {
                    putenv(trim($linha));
                }
            }
        }


        public static function escrever_env($diretorio, $arquivo='', $chave, $valor) {
            $conteudo_env = file_get_contents($diretorio . '/' . $arquivo . '.env');
            if (getenv(strtoupper($chave)) !== false) {
                $padrao = "/^{strtoupper($chave)}=(.*)(\r?\n|$)/m";
                $nova_env = preg_replace($padrao, "{$chave}={$valor}\n", $conteudo_env);
                file_put_contents($diretorio . '/' . $arquivo . '.env', $nova_env);
            } 
            else {
                $nova_env = strtoupper($chave) . '=' . $valor . "\n";
                file_put_contents($diretorio . '/' . $arquivo . '.env', $nova_env, FILE_APPEND);
            } 
            return true;
        }


        public static function apagar_env($diretorio, $arquivo='', $chave) {
            $conteudo_env = file_get_contents($diretorio . '/' . $arquivo . '.env');
            if (getenv(strtoupper($chave)) !== false) {
                $apagar_env = preg_replace("/^{$chave}=(.*)(\r?\n|$)/m", '', $conteudo_env);
                file_put_contents($diretorio . '/' . $arquivo . '.env', $apagar_env);
                return true;
            }
        }
    }
?>