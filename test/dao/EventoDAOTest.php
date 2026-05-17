<?php

namespace test\dao;

use dao\EventoDAO;
use dao\DivulgadorDAO;
use DateTime;
use model\Evento;
use model\Divulgador;
use PHPUnit\Framework\TestCase;

class EventoDAOTest extends TestCase
{
    public function testSalvar()
    {
        $evento = new Evento();
        $evento->setNome("ExpoShow");
        $evento->setDescricao("Evento regional");
        $evento->setCidade("Palmas");
        $evento->setLocal("Parque de Exposições Pé Vermelho");
        $evento->setDataEvento(new DateTime("2026-04-06"));

        $eventoInserido = EventoDAO::salvar($evento);

        $this->assertNotNull($eventoInserido->getId());
    }

    public function testListar()
    {
        $eventos = EventoDAO::listar();
        foreach ($eventos as $evento) {
            echo $evento->getNome() . "\n";
        }

        $this->assertNotNull($eventos);
    }

    public function testBuscarId()
    {
        $evento = new Evento();
        $evento->setNome("Festa Junina");
        $evento->setDescricao("Festa tradicional");
        $evento->setCidade("Palmas");
        $evento->setLocal("Praça Central");
        $evento->setDataEvento(new DateTime("2026-06-15"));
        $evento = EventoDAO::salvar($evento);

        $eventoBuscado = EventoDAO::buscarId($evento->getId());
        $this->assertNotNull($eventoBuscado->getId());
    }

    public function testAtualizar()
    {
        $evento = new Evento();
        $evento->setNome("Show de Rock");
        $evento->setDescricao("Festival de música");
        $evento->setCidade("Palmas");
        $evento->setLocal("Arena");
        $evento->setDataEvento(new DateTime("2026-08-20"));
        $evento = EventoDAO::salvar($evento);

        $eventoEditar = EventoDAO::buscarId($evento->getId());
        $eventoEditar->setNome("Show de Rock Editado");
        $eventoEditado = EventoDAO::salvar($eventoEditar);

        $this->assertEquals("Show de Rock Editado", $eventoEditado->getNome());
        $this->assertEquals($eventoEditado->getId(), $evento->getId());
    }

    public function testDeletar()
    {
        $evento = new Evento();
        $evento->setNome("Evento Deletar");
        $evento->setDescricao("Será deletado");
        $evento->setCidade("Palmas");
        $evento->setLocal("Local Teste");
        $evento->setDataEvento(new DateTime("2026-09-10"));
        $evento = EventoDAO::salvar($evento);

        $eventoDeletar = EventoDAO::buscarId($evento->getId());
        $idDeletar = $eventoDeletar->getId();
        EventoDAO::deletar($eventoDeletar);

        $eventoDeletado = EventoDAO::buscarId($idDeletar);
        $this->assertNull($eventoDeletado);
    }

    public function testSalvarComDivulgador()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Divulgador Teste");
        $divulgador->setCnpj("12.345.678/0001-00");
        $divulgador->setEmail("divulgador@teste.com");
        $divulgador = DivulgadorDAO::salvar($divulgador);

        $evento = new Evento();
        $evento->setNome("Evento com Divulgador");
        $evento->setDescricao("Teste de relacionamento");
        $evento->setCidade("Palmas");
        $evento->setLocal("Centro");
        $evento->setDataEvento(new DateTime("2026-10-01"));
        $evento->setDivulgador($divulgador);

        $eventoInserido = EventoDAO::salvar($evento);

        $this->assertNotNull($eventoInserido->getDivulgador());
    }
}
