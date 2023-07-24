<?php
    namespace MacB;


    class Ambivar {
        private static function analisar_env(string $arquivo_env): array {
            $lista_env = [];

            if (file_exists($arquivo_env)) {
                $linhas = file($arquivo_env, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                
                foreach ($linhas as $linha) {
                    if (str_contains($linha, '=') && str_starts_with($linha, '#') === false) {
                        list($chave, $valor) = explode('=', $linha, 2);
                        $chave = trim($chave);
                        $valor = trim($valor);
                        
                        if (!empty($chave)) {
                            $lista_env[$chave] = $valor;
                        }
                    }
                }
            }

            return $lista_env;
        }


        private static function definir_ambivar(array $lista_env): void {
            foreach ($lista_env as $chave => $valor) {
                putenv("$chave=$valor");
                $_ENV[$chave] = $valor;
                $_SERVER[$chave] = $valor;
            }
        }


        public static function dotenv(): void {
            $caminho_env = __DIR__.'/../../../../.env';
            $lista_env = self::analisar_env($caminho_env);
            self::definir_ambivar($lista_env);
        }


        public static function carregar(string $caminho_env = __DIR__.'/../../../../.env'): void {
            if (file_exists($caminho_env)) {
                $lista_env = self::analisar_env($caminho_env);
                self::definir_ambivar($lista_env);
            }
        }


        public static function obter(string $chave, mixed $valor_padrao = null): mixed {
            return self::existe($chave) ? getenv($chave) : $valor_padrao;
        }


        public static function existe(string $chave): bool {
            return getenv(strtoupper($chave)) !== false;
        }


        public static function gravar(string $chave, mixed $valor, string $caminho_env = __DIR__.'/../../../../.env'): bool {
            if (!file_exists($caminho_env)) return false;
            
            $conteudo_env = file_get_contents($caminho_env);

            if (self::existe(strtoupper($chave))) {
                $padrao = "/^" . preg_quote(strtoupper($chave), '/') . "=(.*)(\r?\n|$)/m";
                $conteudo_env = preg_replace($padrao, "{$chave}={$valor}\n", $conteudo_env);
            } 
            else {
                $conteudo_env .= strtoupper($chave) . '=' . $valor . "\n";
            }

            file_put_contents($caminho_env, $conteudo_env);
            putenv("$chave=$valor");
            $_ENV[$chave] = $valor;
            $_SERVER[$chave] = $valor;

            return true;
        }


        public static function remover(string $chave, string $caminho_env = __DIR__.'/../../../../.env'): bool {
            if (!file_exists($caminho_env)) return false;

            $conteudo_env = file_get_contents($caminho_env);

            if (self::existe($chave)) {
                $padrao = "/^" . preg_quote(strtoupper($chave), '/') . "=(.*)(\r?\n|$)/m";
                $apagar_env = preg_replace($padrao, '', $conteudo_env);
                file_put_contents($caminho_env, $apagar_env);

                unset($_ENV[$chave]);
                unset($_SERVER[$chave]);

                return true;
            }

            return false;
        }


        public static function carregar_pasta(string $diretorio): void {
            $arquivos = glob(rtrim($diretorio, '/') . '/*.env');
            
            foreach ($arquivos as $arquivo) {
                self::carregar($arquivo);
            }
        }
    }
?>