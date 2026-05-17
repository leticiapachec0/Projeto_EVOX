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
        $divulgador->setNome("Eventos Ltda");
        $divulgador->setCnpj("12.345.678/0001-00");
        $divulgador->setEmail("contato@eventosltda.com");

        $divulgadorInserido = DivulgadorDAO::salvar($divulgador);

        $this->assertNotNull($divulgadorInserido->getId());
    }

    public function testListar()
    {
        $divulgadores = DivulgadorDAO::listar();
        foreach ($divulgadores as $divulgador) {
            echo $divulgador->getNome() . "\n";
        }

        $this->assertNotNull($divulgadores);
    }

    public function testBuscarId()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Show Produções");
        $divulgador->setCnpj("98.765.432/0001-11");
        $divulgador->setEmail("show@producoes.com");
        $divulgador = DivulgadorDAO::salvar($divulgador);

        $divulgadorBuscado = DivulgadorDAO::buscarId($divulgador->getId());
        $this->assertNotNull($divulgadorBuscado->getId());
    }

    public function testAtualizar()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Festa Produções");
        $divulgador->setCnpj("11.222.333/0001-44");
        $divulgador->setEmail("festa@producoes.com");
        $divulgador = DivulgadorDAO::salvar($divulgador);

        $divulgadorEditar = DivulgadorDAO::buscarId($divulgador->getId());
        $divulgadorEditar->setNome("Festa Produções Editada");
        $divulgadorEditado = DivulgadorDAO::salvar($divulgadorEditar);

        $this->assertEquals("Festa Produções Editada", $divulgadorEditado->getNome());
        $this->assertEquals($divulgadorEditado->getId(), $divulgador->getId());
    }

    public function testDeletar()
    {
        $divulgador = new Divulgador();
        $divulgador->setNome("Divulgador Deletar");
        $divulgador->setCnpj("55.666.777/0001-88");
        $divulgador->setEmail("deletar@teste.com");
        $divulgador = DivulgadorDAO::salvar($divulgador);

        $divulgadorDeletar = DivulgadorDAO::buscarId($divulgador->getId());
        $idDeletar = $divulgadorDeletar->getId();
        DivulgadorDAO::deletar($divulgadorDeletar);

        $divulgadorDeletado = DivulgadorDAO::buscarId($idDeletar);
        $this->assertNull($divulgadorDeletado);
    }
}
