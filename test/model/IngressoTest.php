<?php

namespace test\model;

use model\Ingresso;
use PHPUnit\Framework\TestCase;

class IngressoTest extends TestCase
{
    public function testCriarObjeto()
    {
        $ingresso = new Ingresso();
        $ingresso->setPreco(100.00);
        $ingresso->setQuantidade(50);

        $this->assertNotNull($ingresso);
    }
}
