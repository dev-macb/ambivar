<?php

namespace MacB;

/**
 * Ambivar - Gerenciador de variáveis de ambiente para PHP
 * 
 * Esta classe fornece métodos para carregar, manipular e acessar
 * variáveis de ambiente através de arquivos .env
 */
class Ambivar {
    /**
     * Constantes para caminhos, modos de operação e caracteres especiais
     */
    const SEPARADOR = '=';
    const ASPAS_DUPLAS = '"';
    const ASPAS_SIMPLES = "'";
    const PREFIXO_COMENTARIO = '#';
    const EXTENSAO_ENV = '.env';
    const CAMINHO_PADRAO = '/.env';
    const CARACTERES_ESPECIAIS = [' ', '#', '='];
    
    /**
     * Diretório base para resolução de caminhos relativos.
     * @var string
     */
    private static string $diretorioBase;

    /**
     * Analisa um arquivo .env e retorna um array de variáveis.
     *
     * @param string $caminhoDoArquivo Caminho completo para o arquivo .env
     * @return array Array associativo com as variáveis do arquivo
     */
    private static function analisarArquivoEnv(string $caminhoDoArquivo): array {
        $variaveisDeAmbiente = [];
        $linhas = Uteis::lerArquivo($caminhoDoArquivo);
    
        foreach ($linhas as $linha) {
            if (empty($linha) || strpos($linha, '#') === 0) continue;
            
            if (strpos($linha, '=') !== false) {
                list($chave, $valor) = explode('=', $linha, 2);
                
                $chave = Uteis::normalizarChave($chave);
                $valor = Uteis::limparAspas(trim($valor));
    
                if (!empty($chave)) {
                    $variaveisDeAmbiente[$chave] = $valor;
                }
            }
        }
    
        return $variaveisDeAmbiente;
    }

    /**
     * Define as variáveis de ambiente a partir de um array.
     *
     * @param array $envVars Array associativo com as variáveis a serem definidas
     */
    private static function definirVariaveisDeAmbiente(array $variaveisDeAmbiente): void {
        foreach ($variaveisDeAmbiente as $chave => $valor) {
            if (!is_string($valor)) {
                $valor = (string)$valor;
            }

            putenv("$chave=$valor");
            $_ENV[$chave] = $valor;
            $_SERVER[$chave] = $valor;
        }
    }

    /**
     * Inicializa o diretório base.
     */
    public static function inicializar(string $diretorioBase = null): void {
        self::$diretorioBase = $diretorioBase ?? dirname(__DIR__, 4);
    }

    /**
     * Carrega as variáveis de ambiente do arquivo .env padrão na raiz do projeto.
     * 
     * @return bool Verdadeiro se o carregamento foi bem-sucedido, falso caso contrário
     */
    public static function dotenv(): bool {
        if (!isset(self::$diretorioBase)) {
            self::inicializar();
        }
        
        $caminhoDoArquivoEnv = self::$diretorioBase . self::CAMINHO_PADRAO;
        return self::carregar($caminhoDoArquivoEnv);
    }

    /**
     * Carrega as variáveis de ambiente de um arquivo .env específico.
     *
     * @param string $caminhoDoArquivoEnv Caminho para o arquivo .env
     * @return bool Verdadeiro se o carregamento foi bem-sucedido, falso caso contrário
     */
    public static function carregar(string $caminhoDoArquivoEnv): bool {
        if (file_exists($caminhoDoArquivoEnv) && is_readable($caminhoDoArquivoEnv)) {
            $variaveisDeAmbiente = self::analisarArquivoEnv($caminhoDoArquivoEnv);
            self::definirVariaveisDeAmbiente($variaveisDeAmbiente);
            return true;
        }
        
        return false;
    }

    /**
     * Carrega todos os arquivos .env em um diretório.
     *
     * @param string $diretorio Caminho para o diretório
     * @return int Número de arquivos carregados com sucesso
     */
    public static function carregarDiretorio(string $diretorio): int {
        $quantidadeDeArquivosCarregados = 0;
        $diretorio = rtrim($diretorio, '/\\');
        
        if (!is_dir($diretorio) || !is_readable($diretorio)) {
            return $quantidadeDeArquivosCarregados;
        }
        
        $files = glob("$diretorio/*" . self::EXTENSAO_ENV);
        if ($files === false) {
            return $quantidadeDeArquivosCarregados;
        }
        
        foreach ($files as $file) {
            if (is_file($file) && is_readable($file) && self::carregar($file)) {
                $quantidadeDeArquivosCarregados++;
            }
        }
        
        return $quantidadeDeArquivosCarregados;
    }

    /**
     * Verifica se uma variável de ambiente existe.
     *
     * @param string $chave Nome da variável
     * @return bool Verdadeiro se a variável existir, falso caso contrário
     */
    public static function existe(string $chave): bool {
        $chave = strtoupper($chave);
        
        return isset($_ENV[$chave]) || isset($_SERVER[$chave]) || getenv($chave) !== false;
    }

    /**
     * Retorna todas as variáveis de ambiente atualmente carregadas.
     *
     * @return array Array associativo com todas as variáveis de ambiente
     */
    public static function obterTodos(): array {
        return $_ENV;
    }

    /**
     * Obtém o valor de uma variável de ambiente.
     *
     * @param string $chave Nome da variável
     * @param mixed $padrao Valor padrão se a variável não existir
     * @return mixed Valor da variável ou o valor padrão
     */
    public static function obter(string $chave, $padrao = null) {
        $chave = strtoupper($chave);
        
        if (isset($_ENV[$chave])) {
            return $_ENV[$chave];
        }
        
        if (isset($_SERVER[$chave])) {
            return $_SERVER[$chave];
        }
        
        $valor = getenv($chave);
        if ($valor !== false) {
            return $valor;
        }
        
        return $padrao;
    }

    /**
     * Adiciona ou atualiza uma variável de ambiente no arquivo .env e no ambiente atual.
     *
     * @param string $chave Nome da variável
     * @param mixed $valor Valor da variável
     * @param string|null $caminhoDoArquivoEnv Caminho para o arquivo .env
     * @return bool Verdadeiro se a operação foi bem-sucedida, falso caso contrário
     */
    public static function adicionar(string $chave, $valor, ?string $caminhoDoArquivoEnv = null): bool {
        if (!isset(self::$diretorioBase)) {
            self::inicializar();
        }
        
        $caminhoDoArquivoEnv = $caminhoDoArquivoEnv ?? self::$diretorioBase . self::CAMINHO_PADRAO;
        if (!file_exists($caminhoDoArquivoEnv)) {
            if (file_put_contents($caminhoDoArquivoEnv, '') === false) {
                return false;
            }
        } 
        else if (!is_writable($caminhoDoArquivoEnv)) {
            return false;
        }
        
        $chave = strtoupper($chave);
        if (!is_string($valor)) {
            $valor = (string)$valor;
        }
        
        // Verificar se o valor precisa ser escapado
        $precisaEscapar = false;
        foreach (self::CARACTERES_ESPECIAIS as $caractere) {
            if (strpos($valor, $caractere) !== false) {
                $precisaEscapar = true;
                break;
            }
        }
        
        if ($precisaEscapar) {
            $valor = self::ASPAS_DUPLAS . str_replace(self::ASPAS_DUPLAS, '\"', $valor) . self::ASPAS_DUPLAS;
        }
        
        $conteudo = file_get_contents($caminhoDoArquivoEnv);
        $pattern = "/^" . preg_quote($chave, '/') . self::SEPARADOR . ".*(\r?\n|$)/m";
        if (preg_match($pattern, $conteudo)) {
            $conteudo = preg_replace($pattern, "$chave" . self::SEPARADOR . "$valor$1", $conteudo);
        } 
        else {
            $conteudo .= "$chave" . self::SEPARADOR . "$valor" . PHP_EOL;
        }
        
        if (file_put_contents($caminhoDoArquivoEnv, $conteudo) === false) {
            return false;
        }
        
        putenv("$chave" . self::SEPARADOR . "$valor");
        $_ENV[$chave] = $valor;
        $_SERVER[$chave] = $valor;
        
        return true;
    }

    /**
     * Define várias variáveis de ambiente de uma só vez.
     *
     * @param array $variaveis Array associativo com as variáveis a serem definidas
     * @param string|null $caminhoDoArquivoEnv Caminho para o arquivo .env
     * @return int Número de variáveis definidas com sucesso
     */
    public static function adicionarVarios(array $variaveis, ?string $caminhoDoArquivoEnv = null): int {
        $quantidade = 0;
        
        foreach ($variaveis as $chave => $valor) {
            if (self::adicionar($chave, $valor, $caminhoDoArquivoEnv)) {
                $quantidade++;
            }
        }
        
        return $quantidade;
    }

    /**
     * Remove uma variável de ambiente do arquivo .env e do ambiente atual.
     *
     * @param string $chave Nome da variável
     * @param string|null $caminhoDoArquivoEnv Caminho para o arquivo .env
     * @return bool Verdadeiro se a operação foi bem-sucedida, falso caso contrário
     */
    public static function remover(string $chave, ?string $caminhoDoArquivoEnv = null): bool {
        if (!isset(self::$diretorioBase)) {
            self::inicializar();
        }
        
        $caminhoDoArquivoEnv = $caminhoDoArquivoEnv ?? self::$diretorioBase . self::CAMINHO_PADRAO;
        if (!file_exists($caminhoDoArquivoEnv) || !is_writable($caminhoDoArquivoEnv)) {
            return false;
        }
        
        $chave = strtoupper($chave);
        if (!self::existe($chave)) {
            return false;
        }
        
        $conteudo = file_get_contents($caminhoDoArquivoEnv);
        $leiaute = "/^" . preg_quote($chave, '/') . self::SEPARADOR . ".*(\r?\n|$)/m";
        $conteudo = preg_replace($leiaute, '', $conteudo);
        if (file_put_contents($caminhoDoArquivoEnv, $conteudo) === false) {
            return false;
        }
        
        putenv($chave);
        unset($_ENV[$chave]);
        unset($_SERVER[$chave]);
        
        return true;
    }
}