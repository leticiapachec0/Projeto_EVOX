<?php
namespace test\model;

use model\Ingresso;
use PHPUnit\Framework\TestCase;

class IngressoTest extends TestCase
{
    public function testCriarObjeto()
    {
        $ingresso = new Ingresso();
        $ingresso->setPreco(50.00);
        $ingresso->setQuantidade(100);

        $this->assertNotNull($ingresso);
        $this->assertEquals(50.00, $ingresso->getPreco());
        $this->assertEquals(100, $ingresso->getQuantidade());
    }
}