<?php
namespace test\model;

use model\Evento;
use DateTime;
use PHPUnit\Framework\TestCase;

class EventosTest extends TestCase
{
    public function testCriarObjeto()
    {
        $evento = new Evento();
        $evento->setNome("Festival de Verão");
        $evento->setDescricao("Evento de música");
        $evento->setCidade("Palmas");
        $evento->setLocal("Arena");
        $evento->setDataEvento(new DateTime("2026-12-01"));

        $this->assertNotNull($evento);
        $this->assertEquals("Festival de Verão", $evento->getNome());
        $this->assertEquals("Palmas", $evento->getCidade());
        $this->assertEquals("Arena", $evento->getLocal());
    }
}