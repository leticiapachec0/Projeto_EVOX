<?php

namespace test\dao;

use dao\IngressoDAO;
use dao\EventoDAO;
use DateTime;
use model\Ingresso;
use model\Evento;
use PHPUnit\Framework\TestCase;

class IngressoDAOTest extends TestCase
{
    private function criarEvento(): Evento
    {
        $evento = new Evento();
        $evento->setNome("Evento Teste Ingresso");
        $evento->setDescricao("Evento para teste");
        $evento->setCidade("Palmas");
        $evento->setLocal("Local Teste");
        $evento->setDataEvento(new DateTime("2026-10-01"));
        return EventoDAO::salvar($evento);
    }

    public function testSalvar()
    {
        $evento = $this->criarEvento();

        $ingresso = new Ingresso();
        $ingresso->setPreco(50.00);
        $ingresso->setQuantidade(100);
        $ingresso->setEvento($evento);

        $ingressoInserido = IngressoDAO::salvar($ingresso);
        $this->assertNotNull($ingressoInserido->getId());
    }

    public function testListar()
    {
        $ingressos = IngressoDAO::listar();
        $this->assertNotNull($ingressos);
    }

    public function testBuscarId()
    {
        $evento = $this->criarEvento();

        $ingresso = new Ingresso();
        $ingresso->setPreco(75.00);
        $ingresso->setQuantidade(50);
        $ingresso->setEvento($evento);
        $ingresso = IngressoDAO::salvar($ingresso);

        $ingressoBuscado = IngressoDAO::buscarId($ingresso->getId());
        $this->assertNotNull($ingressoBuscado->getId());
    }

    public function testAtualizar()
    {
        $evento = $this->criarEvento();

        $ingresso = new Ingresso();
        $ingresso->setPreco(100.00);
        $ingresso->setQuantidade(200);
        $ingresso->setEvento($evento);
        $ingresso = IngressoDAO::salvar($ingresso);

        $ingressoEditar = IngressoDAO::buscarId($ingresso->getId());
        $ingressoEditar->setPreco(120.00);
        $ingressoEditado = IngressoDAO::salvar($ingressoEditar);

        $this->assertEquals(120.00, $ingressoEditado->getPreco());
        $this->assertEquals($ingressoEditado->getId(), $ingresso->getId());
    }

    public function testDeletar()
    {
        $evento = $this->criarEvento();

        $ingresso = new Ingresso();
        $ingresso->setPreco(30.00);
        $ingresso->setQuantidade(10);
        $ingresso->setEvento($evento);
        $ingresso = IngressoDAO::salvar($ingresso);

        $ingressoDeletar = IngressoDAO::buscarId($ingresso->getId());
        $idDeletar = $ingressoDeletar->getId();
        IngressoDAO::deletar($ingressoDeletar);

        $ingressoDeletado = IngressoDAO::buscarId($idDeletar);
        $this->assertNull($ingressoDeletado);
    }

    public function testBuscarQuantidade()
    {
        $evento = $this->criarEvento();

        $ingresso = new Ingresso();
        $ingresso->setPreco(50.00);
        $ingresso->setQuantidade(999);
        $ingresso->setEvento($evento);
        IngressoDAO::salvar($ingresso);

        $ingressos = IngressoDAO::buscarQuantidade(999);
        $this->assertNotEmpty($ingressos);
    }

    public function testBuscarPorEvento()
    {
        $evento = $this->criarEvento();

        $ingresso = new Ingresso();
        $ingresso->setPreco(60.00);
        $ingresso->setQuantidade(80);
        $ingresso->setEvento($evento);
        IngressoDAO::salvar($ingresso);

        $ingressos = IngressoDAO::buscarPorEvento($evento);
        $this->assertNotEmpty($ingressos);
    }

    public function testBuscarPorPrecoMaximoQueryBuilder()
    {
        $evento = $this->criarEvento();

        $ingresso = new Ingresso();
        $ingresso->setPreco(25.00);
        $ingresso->setQuantidade(50);
        $ingresso->setEvento($evento);
        IngressoDAO::salvar($ingresso);

        $ingressos = IngressoDAO::buscarPorPrecoMaximoQueryBuilder(50.00);
        $this->assertNotEmpty($ingressos);
    }

    public function testBuscarPorQuantidadeMinimaDQL()
    {
        $evento = $this->criarEvento();

        $ingresso = new Ingresso();
        $ingresso->setPreco(40.00);
        $ingresso->setQuantidade(150);
        $ingresso->setEvento($evento);
        IngressoDAO::salvar($ingresso);

        $ingressos = IngressoDAO::buscarPorQuantidadeMinimaDQL(100);
        $this->assertNotEmpty($ingressos);
    }
}