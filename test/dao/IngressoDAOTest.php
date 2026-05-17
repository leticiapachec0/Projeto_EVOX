<?php

namespace test\dao;

use dao\EventoDAO;
use dao\IngressoDAO;
use DateTime;
use model\Evento;
use model\Ingresso;
use PHPUnit\Framework\TestCase;

class IngressoDAOTest extends TestCase
{
    public function testSalvar()
    {
        $evento = new Evento();
        $evento->setNome("Show Teste Ingresso");
        $evento->setDescricao("Evento para teste de ingresso");
        $evento->setCidade("Palmas");
        $evento->setLocal("Arena");
        $evento->setDataEvento(new DateTime("2026-11-10"));
        $evento = EventoDAO::salvar($evento);

        $ingresso = new Ingresso();
        $ingresso->setPreco(150.00);
        $ingresso->setQuantidade(200);
        $ingresso->setEvento($evento);

        $ingressoInserido = IngressoDAO::salvar($ingresso);

        $this->assertNotNull($ingressoInserido->getId());
    }

    public function testListar()
    {
        $ingressos = IngressoDAO::listar();
        foreach ($ingressos as $ingresso) {
            echo $ingresso->getPreco() . "\n";
        }

        $this->assertNotNull($ingressos);
    }

    public function testBuscarId()
    {
        $evento = new Evento();
        $evento->setNome("Evento Buscar Ingresso");
        $evento->setDescricao("Teste");
        $evento->setCidade("Palmas");
        $evento->setLocal("Centro");
        $evento->setDataEvento(new DateTime("2026-12-01"));
        $evento = EventoDAO::salvar($evento);

        $ingresso = new Ingresso();
        $ingresso->setPreco(50.00);
        $ingresso->setQuantidade(100);
        $ingresso->setEvento($evento);
        $ingresso = IngressoDAO::salvar($ingresso);

        $ingressoBuscado = IngressoDAO::buscarId($ingresso->getId());
        $this->assertNotNull($ingressoBuscado->getId());
    }

    public function testAtualizar()
    {
        $evento = new Evento();
        $evento->setNome("Evento Atualizar Ingresso");
        $evento->setDescricao("Teste");
        $evento->setCidade("Palmas");
        $evento->setLocal("Parque");
        $evento->setDataEvento(new DateTime("2026-07-20"));
        $evento = EventoDAO::salvar($evento);

        $ingresso = new Ingresso();
        $ingresso->setPreco(80.00);
        $ingresso->setQuantidade(50);
        $ingresso->setEvento($evento);
        $ingresso = IngressoDAO::salvar($ingresso);

        $ingressoEditar = IngressoDAO::buscarId($ingresso->getId());
        $ingressoEditar->setPreco(100.00);
        $ingressoEditado = IngressoDAO::salvar($ingressoEditar);

        $this->assertEquals(100.00, $ingressoEditado->getPreco());
        $this->assertEquals($ingressoEditado->getId(), $ingresso->getId());
    }

    public function testDeletar()
    {
        $evento = new Evento();
        $evento->setNome("Evento Deletar Ingresso");
        $evento->setDescricao("Teste");
        $evento->setCidade("Palmas");
        $evento->setLocal("Local");
        $evento->setDataEvento(new DateTime("2026-05-05"));
        $evento = EventoDAO::salvar($evento);

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
}
