<?php
namespace test\model;

use model\Pedido;
use DateTime;
use PHPUnit\Framework\TestCase;

class PedidoTest extends TestCase
{
    public function testCriarObjeto()
    {
        $pedido = new Pedido();
        $pedido->setData(new DateTime("2026-06-01"));
        $pedido->setQuantidade(2);
        $pedido->setTotal(100.00);

        $this->assertNotNull($pedido);
        $this->assertEquals(2, $pedido->getQuantidade());
        $this->assertEquals(100.00, $pedido->getTotal());
    }
}