<?php

namespace MacB\Tests\Uteis;

use MacB\Uteis;
use PHPUnit\Framework\TestCase;

class LerArquivoTest extends TestCase {
    private string $arquivoTemporario;

    protected function setUp(): void {
        // Criar um arquivo temporário para os testes
        $this->arquivoTemporario = tempnam(sys_get_temp_dir(), 'test');
    }

    protected function tearDown(): void {
        // Remover o arquivo temporário após os testes
        if (file_exists($this->arquivoTemporario)) {
            unlink($this->arquivoTemporario);
        }
    }

    /** @test */
    public function test_deve_retornar_array_de_linhas_quando_arquivo_valido() {
        // Arrange
        file_put_contents($this->arquivoTemporario, "Linha 1\nLinha 2\nLinha 3");

        // Act
        $resultado = Uteis::lerArquivo($this->arquivoTemporario);

        // Assert
        $this->assertEquals(['Linha 1', 'Linha 2', 'Linha 3'], $resultado);
    }

    /** @test */
    public function test_deve_retornar_array_vazio_quando_arquivo_nao_existe() {
        // Arrange
        $caminhoInexistente = sys_get_temp_dir() . '/arquivo_inexistente.txt';

        // Act
        $resultado = Uteis::lerArquivo($caminhoInexistente);

        // Assert
        $this->assertEquals([], $resultado);
    }

    /** @test */
    public function test_deve_retornar_array_vazio_quando_arquivo_vazio() {
        // Arrange
        file_put_contents($this->arquivoTemporario, "");

        // Act
        $resultado = Uteis::lerArquivo($this->arquivoTemporario);

        // Assert
        $this->assertEquals([], $resultado);
    }

    /** @test */
    public function test_deve_retornar_linhas_validas_ignorando_linhas_vazias_e_comentarios() {
        // Arrange
        file_put_contents($this->arquivoTemporario, "\nLinha 1\n\n# Comentário\nLinha 2");

        // Act
        $resultado = Uteis::lerArquivo($this->arquivoTemporario);

        // Assert
        $this->assertEquals(['Linha 1', 'Linha 2'], $resultado);
    }
}