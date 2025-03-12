<?php

namespace MacB\Tests\Uteis;

use MacB\Uteis;
use PHPUnit\Framework\TestCase;

class EscaparValorTest extends TestCase {
    /** @test */
    public function test_deve_retornar_o_mesmo_valor_se_nao_contiver_caracteres_especiais() {
        // Arrange
        $valor = 'TextoSimples';

        // Act
        $resultado = Uteis::escaparValor($valor);

        // Assert
        $this->assertEquals('TextoSimples', $resultado);
    }

    /** @test */
    public function test_deve_escapar_valor_se_conter_espaco() {
        // Arrange
        $valor = 'Texto Simples';

        // Act
        $resultado = Uteis::escaparValor($valor);

        // Assert
        $this->assertEquals('"Texto Simples"', $resultado);
    }

    /** @test */
    public function test_deve_escapar_valor_se_conter_sinal_de_igual() {
        // Arrange
        $valor = 'chave=valor';

        // Act
        $resultado = Uteis::escaparValor($valor);

        // Assert
        $this->assertEquals('"chave=valor"', $resultado);
    }

    /** @test */
    public function test_deve_escapar_valor_se_conter_cerquilha() {
        // Arrange
        $valor = 'comentário # aqui';

        // Act
        $resultado = Uteis::escaparValor($valor);

        // Assert
        $this->assertEquals('"comentário # aqui"', $resultado);
    }

    /** @test */
    public function test_deve_manter_o_valor_entre_aspas_se_ja_estiver_escapado() {
        // Arrange
        $valor = '"Texto já escapado"';

        // Act
        $resultado = Uteis::escaparValor($valor);

        // Assert
        $this->assertEquals('"Texto já escapado"', $resultado);
    }

    /** @test */
    public function test_deve_escapar_valores_com_multiplos_caracteres_especiais() {
        // Arrange
        $valor = 'Teste # com = espaço';

        // Act
        $resultado = Uteis::escaparValor($valor);

        // Assert
        $this->assertEquals('"Teste # com = espaço"', $resultado);
    }

    /** @test */
    public function test_deve_escapar_valor_vazio() {
        // Arrange
        $valor = '';

        // Act
        $resultado = Uteis::escaparValor($valor);

        // Assert
        $this->assertEquals('""', $resultado);
    }

    /** @test */
    public function test_deve_escapar_valor_com_apenas_um_espaco() {
        // Arrange
        $valor = ' ';

        // Act
        $resultado = Uteis::escaparValor($valor);

        // Assert
        $this->assertEquals('" "', $resultado);
    }
}
