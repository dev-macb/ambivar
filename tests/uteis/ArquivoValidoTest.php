<?php

namespace MacB\Tests\Uteis;

use MacB\Uteis;
use PHPUnit\Framework\TestCase;

class ArquivoValidoTest extends TestCase
{
    /** @test */
    public function test_arquivo_valido_deve_retornar_verdadeiro() {
        // Arrange
        $arquivo = tempnam(sys_get_temp_dir(), 'test');
        file_put_contents($arquivo, "teste");

        // Act & Assert
        $this->assertTrue(Uteis::arquivoValido($arquivo));

        // Teardown
        unlink($arquivo);
    }

    /** @test */
    public function test_arquivo_valido_com_caminho_invalido_deve_retornar_falso() {
        // Arrange
        $arquivoInexistente = sys_get_temp_dir() . '/arquivo_que_nao_existe.txt';

        // Act & Assert
        $this->assertFalse(Uteis::arquivoValido($arquivoInexistente));
    }

    /** @test */
    public function test_arquivo_valido_com_caminho_de_diretorio_deve_retornar_falso() {
        // Arrange
        $diretorio = sys_get_temp_dir();
        
        // Act & Assert
        $this->assertFalse(Uteis::arquivoValido(false));
    }

    /** @test */
    public function test_arquivo_valido_com_caminho_de_arquivo_vazio_deve_retornar_falso() {
        // Arrange
        $arquivoVazio = tempnam(sys_get_temp_dir(), 'test');
        
        // Act & Assert
        $this->assertFalse(Uteis::arquivoValido(false));

        // Teardown
        unlink($arquivoVazio);
    }
}