<?php 
    namespace MacB\Ambivar;

    
    class Ambivar {
        public static function carregar($caminho) {
            if (file_exists($caminho.'/.env')) {
                $linhas = file($caminho.'/.env');
                foreach($linhas as $linha) {
                    putenv(trim($linha));
                }
                return true;
            }
            return false;
        }
    }
?>