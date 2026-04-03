<?php

namespace test\dao;

use dao\EventoDAO;
use model\Evento;
use PHPUnit\Framework\TestCase;


class EventoDAOTest extends TestCase {
    public function testSalvar() {
        $evento=new Evento();
        $evento-> setCidade("Palmas");
        $evento-> setDataEvento(new \DateTime("2026-04-06"));
        $evento-> setLocal("Parque de Exposições Pé Vermelho");

        $eventoInserido = EventoDAO::salvar($evento);

        $this -> assertNotNull($eventoInserido->getId());

    }

}