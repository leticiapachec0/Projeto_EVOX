<?php

namespace test\model;

use DateTime;
use model\Pedido;
use PHPUnit\Framework\TestCase;

class PedidoTest extends TestCase
{
    public function testCriarObjeto()
    {
        $pedido = new Pedido();
        $pedido->setData(new DateTime());
        $pedido->setQuantidade(2);
        $pedido->setTotal(200.00);

        $this->assertNotNull($pedido);
    }
}
