<?php

namespace test\dao;

use dao\PedidoDAO;
use dao\CompradorDAO;
use dao\EventoDAO;
use DateTime;
use model\Pedido;
use model\Comprador;
use model\Evento;
use PHPUnit\Framework\TestCase;

class PedidoDAOTest extends TestCase
{
    private function criarComprador(): Comprador
    {
        $comprador = new Comprador();
        $comprador->setNome("Comprador Teste");
        $comprador->setCpf("111.222.333-44");
        $comprador->setEmail("comprador@teste.com");
        $comprador->setIdade(30);
        return CompradorDAO::salvar($comprador);
    }

    private function criarEvento(): Evento
    {
        $evento = new Evento();
        $evento->setNome("Evento Teste Pedido");
        $evento->setDescricao("Evento para teste de pedido");
        $evento->setCidade("Palmas");
        $evento->setLocal("Local Teste");
        $evento->setDataEvento(new DateTime("2026-10-01"));
        return EventoDAO::salvar($evento);
    }

    public function testSalvar()
    {
        $comprador = $this->criarComprador();
        $evento = $this->criarEvento();

        $pedido = new Pedido();
        $pedido->setData(new DateTime("2026-06-01"));
        $pedido->setQuantidade(2);
        $pedido->setTotal(100.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);

        $pedidoInserido = PedidoDAO::salvar($pedido);
        $this->assertNotNull($pedidoInserido->getId());
    }

    public function testListar()
    {
        $pedidos = PedidoDAO::listar();
        $this->assertNotNull($pedidos);
    }

    public function testBuscarId()
    {
        $comprador = $this->criarComprador();
        $evento = $this->criarEvento();

        $pedido = new Pedido();
        $pedido->setData(new DateTime("2026-06-02"));
        $pedido->setQuantidade(1);
        $pedido->setTotal(50.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);
        $pedido = PedidoDAO::salvar($pedido);

        $pedidoBuscado = PedidoDAO::buscarId($pedido->getId());
        $this->assertNotNull($pedidoBuscado->getId());
    }

    public function testAtualizar()
    {
        $comprador = $this->criarComprador();
        $evento = $this->criarEvento();

        $pedido = new Pedido();
        $pedido->setData(new DateTime("2026-06-03"));
        $pedido->setQuantidade(3);
        $pedido->setTotal(150.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);
        $pedido = PedidoDAO::salvar($pedido);

        $pedidoEditar = PedidoDAO::buscarId($pedido->getId());
        $pedidoEditar->setTotal(200.00);
        $pedidoEditado = PedidoDAO::salvar($pedidoEditar);

        $this->assertEquals(200.00, $pedidoEditado->getTotal());
        $this->assertEquals($pedidoEditado->getId(), $pedido->getId());
    }

    public function testDeletar()
    {
        $comprador = $this->criarComprador();
        $evento = $this->criarEvento();

        $pedido = new Pedido();
        $pedido->setData(new DateTime("2026-06-04"));
        $pedido->setQuantidade(1);
        $pedido->setTotal(25.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);
        $pedido = PedidoDAO::salvar($pedido);

        $pedidoDeletar = PedidoDAO::buscarId($pedido->getId());
        $idDeletar = $pedidoDeletar->getId();
        PedidoDAO::deletar($pedidoDeletar);

        $pedidoDeletado = PedidoDAO::buscarId($idDeletar);
        $this->assertNull($pedidoDeletado);
    }

    public function testBuscarQuantidade()
    {
        $comprador = $this->criarComprador();
        $evento = $this->criarEvento();

        $pedido = new Pedido();
        $pedido->setData(new DateTime("2026-06-05"));
        $pedido->setQuantidade(5);
        $pedido->setTotal(250.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);
        PedidoDAO::salvar($pedido);

        $pedidos = PedidoDAO::buscarQuantidade(5);
        $this->assertNotEmpty($pedidos);
    }

    public function testBuscarPorComprador()
    {
        $comprador = $this->criarComprador();
        $evento = $this->criarEvento();

        $pedido = new Pedido();
        $pedido->setData(new DateTime("2026-06-06"));
        $pedido->setQuantidade(2);
        $pedido->setTotal(100.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);
        PedidoDAO::salvar($pedido);

        $pedidos = PedidoDAO::buscarPorComprador($comprador);
        $this->assertNotEmpty($pedidos);
    }

    public function testBuscarPorTotalMinimoQueryBuilder()
    {
        $comprador = $this->criarComprador();
        $evento = $this->criarEvento();

        $pedido = new Pedido();
        $pedido->setData(new DateTime("2026-06-07"));
        $pedido->setQuantidade(4);
        $pedido->setTotal(500.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);
        PedidoDAO::salvar($pedido);

        $pedidos = PedidoDAO::buscarPorTotalMinimoQueryBuilder(400.00);
        $this->assertNotEmpty($pedidos);
    }

    public function testBuscarPorEventoDQL()
    {
        $comprador = $this->criarComprador();
        $evento = $this->criarEvento();

        $pedido = new Pedido();
        $pedido->setData(new DateTime("2026-06-08"));
        $pedido->setQuantidade(1);
        $pedido->setTotal(75.00);
        $pedido->setComprador($comprador);
        $pedido->setEvento($evento);
        PedidoDAO::salvar($pedido);

        $pedidos = PedidoDAO::buscarPorEventoDQL($evento);
        $this->assertNotEmpty($pedidos);
    }
}