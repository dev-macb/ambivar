<?php

namespace MacB\Tests\Uteis;

use MacB\Uteis;
use PHPUnit\Framework\TestCase;

class NormalizarChaveTest extends TestCase {
    /** @test */
    public function test_deve_retornar_string_com_chave_normalizada() {
        // Act & Assert
        $this->assertEquals('NOME', Uteis::normalizarChave(' nome '));
        $this->assertEquals('CHAVE', Uteis::normalizarChave('Chave'));
        $this->assertEquals('VARIAVEL_123', Uteis::normalizarChave(' variavel_123 '));
    }
}