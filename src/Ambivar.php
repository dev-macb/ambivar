<?php
    namespace DevMacb;


    class Ambivar {
        public static function dotenv() {
            $arquivo_env = __DIR__.'/../../../../.env';
            if (file_exists($arquivo_env)) {
                $linhas = file($arquivo_env);
                foreach($linhas as $linha) {
                    putenv(trim($linha));
                }
            }
        }

        public static function carregar(string $caminho) {
            if (file_exists($caminho.'/.env')) return false;

            $linhas = file($caminho.'/.env');
            foreach($linhas as $linha) {
                putenv(trim($linha));
            }
            return true;
        }


        public static function escrever_env(string $nome, string $valor) {
            $conteudo_env = file_get_contents('.env');
            $new_env_variable = "\n{$nome}={$valor}";
            file_put_contents('.env', $conteudo_env . $new_env_variable, FILE_APPEND);
        }


        public static function apagar_env(string $nome) {
            $conteudo_env = file_get_contents('.env');
            $pattern = "/^{strtoupper($nome)}=.*/m";
            $new_env_contents = preg_replace($pattern, '', $conteudo_env);
            file_put_contents('.env', $new_env_contents);
        }
    }
?>
