<?php

namespace test\model;

use model\Divulgador;
use PHPUnit\Framework\TestCase;

class DivulgadorTest extends TestCase
{
    public function testCriarObjeto()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Eventos Ltda");
        $divulgador->setCnpj("12.345.678/0001-00");
        $divulgador->setEmail("contato@eventosltda.com");

        $this->assertNotNull($divulgador);
    }
}
