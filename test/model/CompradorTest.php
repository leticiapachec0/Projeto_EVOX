<?php
namespace test\model;

use model\Comprador;
use PHPUnit\Framework\TestCase;

class CompradorTest extends TestCase
{
    public function testCriarObjeto()
    {
        $comprador = new Comprador();
        $comprador->setNome("João Silva");
        $comprador->setCpf("123.456.789-00");
        $comprador->setEmail("joao@email.com");
        $comprador->setIdade(25);

        $this->assertNotNull($comprador);
        $this->assertEquals("João Silva", $comprador->getNome());
        $this->assertEquals("123.456.789-00", $comprador->getCpf());
        $this->assertEquals("joao@email.com", $comprador->getEmail());
        $this->assertEquals(25, $comprador->getIdade());
    }
}