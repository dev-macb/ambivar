<?php

namespace MacB\Tests\Uteis;

use MacB\Uteis;
use PHPUnit\Framework\TestCase;

class LimparAspasTest extends TestCase {
    public function test_deve_remover_aspas_duplas_se_estiverem_no_inicio_e_fim() {
        // Arrange
        $valor = '"Texto com aspas"';

        // Act
        $resultado = Uteis::limparAspas($valor);

        // Assert
        $this->assertEquals('Texto com aspas', $resultado);
    }

    public function test_deve_remover_aspas_simples_se_estiverem_no_inicio_e_fim() {
        // Arrange
        $valor = "'Texto entre aspas'";

        // Act
        $resultado = Uteis::limparAspas($valor);

        // Assert
        $this->assertEquals('Texto entre aspas', $resultado);
    }

    public function test_nao_deve_remover_aspas_se_estiverem_somente_no_inicio() {
        // Arrange
        $valor = '"Texto sem fechamento de aspas';

        // Act
        $resultado = Uteis::limparAspas($valor);

        // Assert
        $this->assertEquals('"Texto sem fechamento de aspas', $resultado);
    }

    public function test_nao_deve_remover_aspas_se_estiverem_somente_no_final() {
        // Arrange
        $valor = "Texto sem abertura de aspas'";

        // Act
        $resultado = Uteis::limparAspas($valor);

        // Assert
        $this->assertEquals("Texto sem abertura de aspas'", $resultado);
    }

    public function test_nao_deve_alterar_valores_sem_aspas() {
        // Arrange
        $valor = "Texto sem aspas";

        // Act
        $resultado = Uteis::limparAspas($valor);

        // Assert
        $this->assertEquals("Texto sem aspas", $resultado);
    }

    public function test_nao_deve_alterar_strings_vazias() {
        // Arrange
        $valor = "";

        // Act
        $resultado = Uteis::limparAspas($valor);

        // Assert
        $this->assertEquals("", $resultado);
    }

    public function test_nao_deve_alterar_numeros() {
        // Arrange
        $valor = "12345";

        // Act
        $resultado = Uteis::limparAspas($valor);

        // Assert
        $this->assertEquals("12345", $resultado);
    }

    public function test_nao_deve_alterar_caracteres_especiais_sem_aspas() {
        // Arrange
        $valor = "@#%&*()";

        // Act
        $resultado = Uteis::limparAspas($valor);

        // Assert
        $this->assertEquals("@#%&*()", $resultado);
    }
}