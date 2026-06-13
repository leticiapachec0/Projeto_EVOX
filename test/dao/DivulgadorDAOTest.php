<?php

namespace test\dao;

use dao\DivulgadorDAO;
use model\Divulgador;
use PHPUnit\Framework\TestCase;

class DivulgadorDAOTest extends TestCase
{
    public function testSalvar()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Show Events");
        $divulgador->setCnpj("12.345.678/0001-00");
        $divulgador->setEmail("show@events.com");

        $divulgadorInserido = DivulgadorDAO::salvar($divulgador);
        $this->assertNotNull($divulgadorInserido->getId());
    }

    public function testListar()
    {
        $divulgadores = DivulgadorDAO::listar();
        $this->assertNotNull($divulgadores);
    }

    public function testBuscarId()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Festa Produções");
        $divulgador->setCnpj("98.765.432/0001-00");
        $divulgador->setEmail("festa@producoes.com");
        $divulgador = DivulgadorDAO::salvar($divulgador);

        $divulgadorBuscado = DivulgadorDAO::buscarId($divulgador->getId());
        $this->assertNotNull($divulgadorBuscado->getId());
    }

    public function testAtualizar()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Som e Luz");
        $divulgador->setCnpj("11.222.333/0001-00");
        $divulgador->setEmail("som@luz.com");
        $divulgador = DivulgadorDAO::salvar($divulgador);

        $divulgadorEditar = DivulgadorDAO::buscarId($divulgador->getId());
        $divulgadorEditar->setNome("Som e Luz Editado");
        $divulgadorEditado = DivulgadorDAO::salvar($divulgadorEditar);

        $this->assertEquals("Som e Luz Editado", $divulgadorEditado->getNome());
        $this->assertEquals($divulgadorEditado->getId(), $divulgador->getId());
    }

    public function testDeletar()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Deletar Eventos");
        $divulgador->setCnpj("44.555.666/0001-00");
        $divulgador->setEmail("deletar@eventos.com");
        $divulgador = DivulgadorDAO::salvar($divulgador);

        $divulgadorDeletar = DivulgadorDAO::buscarId($divulgador->getId());
        $idDeletar = $divulgadorDeletar->getId();
        DivulgadorDAO::deletar($divulgadorDeletar);

        $divulgadorDeletado = DivulgadorDAO::buscarId($idDeletar);
        $this->assertNull($divulgadorDeletado);
    }

    public function testBuscarNome()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Rock Total");
        $divulgador->setCnpj("55.666.777/0001-00");
        $divulgador->setEmail("rock@total.com");
        DivulgadorDAO::salvar($divulgador);

        $divulgadores = DivulgadorDAO::buscarNome("Rock Total");
        $this->assertNotEmpty($divulgadores);
    }

    public function testBuscarEmail()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Pop Music");
        $divulgador->setCnpj("66.777.888/0001-00");
        $divulgador->setEmail("pop@music.com");
        DivulgadorDAO::salvar($divulgador);

        $divulgadores = DivulgadorDAO::buscarEmail("pop@music.com");
        $this->assertNotEmpty($divulgadores);
    }

    public function testBuscarNomeParecidoQueryBuilder()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Jazz Festival");
        $divulgador->setCnpj("77.888.999/0001-00");
        $divulgador->setEmail("jazz@festival.com");
        DivulgadorDAO::salvar($divulgador);

        $divulgadores = DivulgadorDAO::buscarNomeParecidoQueryBuilder("Jazz");
        $this->assertNotEmpty($divulgadores);
    }

    public function testBuscarPorCnpjDQL()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Samba Show");
        $divulgador->setCnpj("88.999.000/0001-00");
        $divulgador->setEmail("samba@show.com");
        DivulgadorDAO::salvar($divulgador);

        $divulgadores = DivulgadorDAO::buscarPorCnpjDQL("88.999.000/0001-00");
        $this->assertNotEmpty($divulgadores);
    }
}