<?php
namespace test\model;

use model\Divulgador;
use PHPUnit\Framework\TestCase;

class DivulgadorTest extends TestCase
{
    public function testCriarObjeto()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Rock Total");
        $divulgador->setCnpj("12.345.678/0001-00");
        $divulgador->setEmail("rock@total.com");

        $this->assertNotNull($divulgador);
        $this->assertEquals("Rock Total", $divulgador->getNome());
        $this->assertEquals("12.345.678/0001-00", $divulgador->getCnpj());
        $this->assertEquals("rock@total.com", $divulgador->getEmail());
    }
}