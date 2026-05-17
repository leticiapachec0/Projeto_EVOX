<?php

namespace test\dao;

use dao\CompradorDAO;
use dao\EventoDAO;
use dao\PedidoDAO;
use DateTime;
use model\Comprador;
use model\Evento;
use model\Pedido;
use PHPUnit\Framework\TestCase;

class PedidoDAOTest extends TestCase
{
    public function testSalvar()
    {
        $comprador = new Comprador();
        $comprador->setNome("Lucas Teste");
        $comprador->setCpf("000.111.222-33");
        $comprador->setEmail("lucas@email.com");
        $comprador->setIdade(20);
        $comprador = CompradorDAO::salvar($comprador);

        $evento = new Evento();
        $evento->setNome("Festival Teste");
        $evento->setDescricao("Evento para pedido");
        $evento->setCidade("Palmas");
        $evento->setLocal("Centro");
        $evento->setDataEvento(new DateTime("2026-09-01"));
        $evento = EventoDAO::salvar($evento);

        $pedido = new Pedido();
        $pedido->setData(new DateTime());
        $pedido->setQuantidade(2);
        $pedido->setTotal(300.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);

        $pedidoInserido = PedidoDAO::salvar($pedido);

        $this->assertNotNull($pedidoInserido->getId());
    }

    public function testListar()
    {
        $pedidos = PedidoDAO::listar();
        foreach ($pedidos as $pedido) {
            echo $pedido->getTotal() . "\n";
        }

        $this->assertNotNull($pedidos);
    }

    public function testBuscarId()
    {
        $comprador = new Comprador();
        $comprador->setNome("Fernanda Buscar");
        $comprador->setCpf("444.555.666-77");
        $comprador->setEmail("fernanda@email.com");
        $comprador->setIdade(27);
        $comprador = CompradorDAO::salvar($comprador);

        $evento = new Evento();
        $evento->setNome("Evento Buscar Pedido");
        $evento->setDescricao("Teste");
        $evento->setCidade("Palmas");
        $evento->setLocal("Parque");
        $evento->setDataEvento(new DateTime("2026-10-10"));
        $evento = EventoDAO::salvar($evento);

        $pedido = new Pedido();
        $pedido->setData(new DateTime());
        $pedido->setQuantidade(1);
        $pedido->setTotal(150.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);
        $pedido = PedidoDAO::salvar($pedido);

        $pedidoBuscado = PedidoDAO::buscarId($pedido->getId());
        $this->assertNotNull($pedidoBuscado->getId());
    }

    public function testAtualizar()
    {
        $comprador = new Comprador();
        $comprador->setNome("Carlos Atualizar");
        $comprador->setCpf("777.888.999-00");
        $comprador->setEmail("carlos@email.com");
        $comprador->setIdade(35);
        $comprador = CompradorDAO::salvar($comprador);

        $evento = new Evento();
        $evento->setNome("Evento Atualizar Pedido");
        $evento->setDescricao("Teste");
        $evento->setCidade("Palmas");
        $evento->setLocal("Arena");
        $evento->setDataEvento(new DateTime("2026-11-20"));
        $evento = EventoDAO::salvar($evento);

        $pedido = new Pedido();
        $pedido->setData(new DateTime());
        $pedido->setQuantidade(3);
        $pedido->setTotal(450.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);
        $pedido = PedidoDAO::salvar($pedido);

        $pedidoEditar = PedidoDAO::buscarId($pedido->getId());
        $pedidoEditar->setTotal(500.00);
        $pedidoEditado = PedidoDAO::salvar($pedidoEditar);

        $this->assertEquals(500.00, $pedidoEditado->getTotal());
        $this->assertEquals($pedidoEditado->getId(), $pedido->getId());
    }

    public function testDeletar()
    {
        $comprador = new Comprador();
        $comprador->setNome("Julia Deletar");
        $comprador->setCpf("333.444.555-66");
        $comprador->setEmail("julia@email.com");
        $comprador->setIdade(24);
        $comprador = CompradorDAO::salvar($comprador);

        $evento = new Evento();
        $evento->setNome("Evento Deletar Pedido");
        $evento->setDescricao("Teste");
        $evento->setCidade("Palmas");
        $evento->setLocal("Local");
        $evento->setDataEvento(new DateTime("2026-06-30"));
        $evento = EventoDAO::salvar($evento);

        $pedido = new Pedido();
        $pedido->setData(new DateTime());
        $pedido->setQuantidade(1);
        $pedido->setTotal(100.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);
        $pedido = PedidoDAO::salvar($pedido);

        $pedidoDeletar = PedidoDAO::buscarId($pedido->getId());
        $idDeletar = $pedidoDeletar->getId();
        PedidoDAO::deletar($pedidoDeletar);

        $pedidoDeletado = PedidoDAO::buscarId($idDeletar);
        $this->assertNull($pedidoDeletado);
    }
}
