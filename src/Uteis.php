<?php

namespace MacB;

/**
 * Classe de métodos auxiliares para Ambivar
 */
class Uteis
{
    /**
     * Verifica se um arquivo existe e pode ser lido.
     */
    public static function arquivoValido(string $caminho): bool {
        return file_exists($caminho) && is_readable($caminho);
    }

    /**
     * Escapa valores contendo caracteres especiais.
     */
    public static function escaparValor(string $valor): string {
        // Se o valor já estiver entre aspas, mantenha-o como está
        if ((str_starts_with($valor, '"') && str_ends_with($valor, '"')) ||
            (str_starts_with($valor, "'") && str_ends_with($valor, "'"))) {
            return $valor;
        }
    
        // Se for vazio, retorna aspas duplas
        if ($valor === '') {
            return '""';
        }
    
        // Se contém espaços, cerquilha (#) ou igual (=), adiciona aspas
        if (preg_match('/[\s#=]/', $valor)) {
            return '"' . str_replace('"', '\"', $valor) . '"';
        }
    
        return $valor;
    }

    /**
     * Lê o conteúdo de um arquivo e retorna um array de linhas.
     */
    public static function lerArquivo(string $caminho): array {
        if (!self::arquivoValido($caminho)) {
            return [];
        }
    
        $linhas = file($caminho, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $linhasFiltradas = array_filter($linhas, fn($linha) => strpos(trim($linha), '#') !== 0);
    
        return array_values($linhasFiltradas);
    }

    /**
     * Remove aspas duplas ou simples de um valor, se existirem.
     */
    public static function limparAspas(string $valor): string {
        return preg_replace('/^["\'](.*)["\']$/', '$1', trim($valor));
    }

    /**
     * Normaliza a chave de uma variável de ambiente.
     */
    public static function normalizarChave(string $chave): string {
        return strtoupper(trim($chave));
    }
}