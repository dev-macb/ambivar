<?php

namespace MacB\Tests\Uteis;

use MacB\Uteis;
use PHPUnit\Framework\TestCase;

class TesteEscaparValor extends TestCase {
    /** @test */
    public function deveRetornarStringSimples() {
        // Arrange
        $valor = "TextoSimples";
        $esperado = "TextoSimples";

        // Act & Assert
        $this->assertEquals($esperado, Uteis::escaparValor($valor));
    }

    /** @test */
    public function deveRetornarStringComApasSimplesNormalizadas() {
        // Arrange
        $valor = "O'Reilly";
        $esperado = '"O\'Reilly"';

        // Act & Assert
        $this->assertEquals($esperado, Uteis::escaparValor($valor));
    }

    /** @test */
    public function deveRetornarStringComApasDuplasNormalizadas() {
        // Arrange
        $valor = 'Texto "importante"';
        $esperado = "'Texto \"importante\"'";

        // Act & Assert
        $this->assertEquals($esperado, Uteis::escaparValor($valor));
    }

    /** @test */
    public function deveRetornarValorNumerico() {
        // Arrange
        $valor = 12345;

        // Act & Assert
        $this->assertEquals(12345, Uteis::escaparValor($valor));
    }

    /** @test */
    public function deveRetornaStringComValorVerdadeiro() {
        // Act & Assert
        $this->assertEquals('true', Uteis::escaparValor(true));
        $this->assertEquals('false', Uteis::escaparValor(false));
    }

    /** @test */
    public function deveRetornaStringComValorNulo() {
        // Act & Assert
        $this->assertEquals('null', Uteis::escaparValor(null));
    }
}