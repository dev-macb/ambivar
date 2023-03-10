<?php 
    namespace DevMacB\Ambivar;


    class Ambivar {
        public static function Carregar(string $caminho = __DIR__) {
            if (file_exists($caminho.'/.env')) return false;

            $linhas = file($caminho.'/.env');
            foreach($linhas as $linha) {
                putenv(trim($linha));
            }

            return true;
        }


        public static function Definir_Variavel(string $nome, string $valor) {
            $conteudo_env = file_get_contents('.env');
            $new_env_variable = "\n{$nome}={$valor}";
            file_put_contents('.env', $conteudo_env . $new_env_variable, FILE_APPEND);
        }


        public static function Apagar_Variavel(string $nome) {
            $conteudo_env = file_get_contents('.env');
            $pattern = "/^{strtoupper($nome)}=.*/m";
            $new_env_contents = preg_replace($pattern, '', $conteudo_env);
            file_put_contents('.env', $new_env_contents);
        }
    }
?>