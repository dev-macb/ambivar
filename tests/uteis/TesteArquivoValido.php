<?php

namespace MacB\Tests\Uteis;

use MacB\Uteis;
use PHPUnit\Framework\TestCase;

class TesteArquivoValido extends TestCase {
    /** @test */
    public function testArquivoExistenteRetornaVerdadeiro() {
        // Arrange
        $arquivo = tempnam(sys_get_temp_dir(), 'test');
        file_put_contents($arquivo, "Conteúdo de teste");

        // Act & Assert
        $this->assertTrue(Uteis::arquivoValido($arquivo));

        // Teardown
        unlink($arquivo);
    }

    /** @test */
    public function ArquivoValidoComCaminhoDoArquivoInvalidoDeveRetornarFalso() {
        // Arrange
        $arquivoInexistente = sys_get_temp_dir() . '/arquivo_que_nao_existe.txt';

        // Act & Assert
        $this->assertFalse(Uteis::arquivoValido($arquivoInexistente));
    }

    /** @test */
    public function ArquivoValidoComCaminhoDeDiretorioDeveRetornarFalso() {
        // Arrange
        $diretorio = sys_get_temp_dir();
        
        // Act & Assert
        $this->assertFalse(Uteis::arquivoValido($diretorio));
    }

    /** @test */
    public function ArquivoValidoComCaminhoDoArquivoVazioDeveRetornarFalso() {
        // Arrange
        $arquivoVazio = tempnam(sys_get_temp_dir(), 'test');
        
        // Act & Assert
        $this->assertFalse(Uteis::arquivoValido($arquivoVazio));

        // Teardown
        unlink($arquivoVazio);
    }
}