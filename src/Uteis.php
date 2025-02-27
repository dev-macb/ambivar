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
     * Lê o conteúdo de um arquivo e retorna um array de linhas.
     */
    public static function lerArquivo(string $caminho): array {
        return self::arquivoValido($caminho) ? file($caminho, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    }

    /**
     * Normaliza a chave de uma variável de ambiente.
     */
    public static function normalizarChave(string $chave): string {
        return strtoupper(trim($chave));
    }

    /**
     * Remove aspas duplas ou simples de um valor, se existirem.
     */
    public static function limparAspas(string $valor): string {
        return preg_replace('/^["\'](.*)["\']$/', '$1', trim($valor));
    }

    /**
     * Escapa valores contendo caracteres especiais.
     */
    public static function escaparValor(string $valor): string {
        return preg_match('/[\s#=]/', $valor) ? '"' . str_replace('"', '\"', $valor) . '"' : $valor;
    }
}