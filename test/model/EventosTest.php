<?php

namespace test\model;

use model\Evento;
use PHPUnit\Framework\TestCase;

class EventosTest extends TestCase {

    public function testCriarObjeto() {
        $evento = new Evento();
        $evento->setCidade("Palmas");
        $evento->setLocal("Centro");
        $evento->setDataEvento(new \DateTime());

        $this->assertNotNull($evento);
    }

}