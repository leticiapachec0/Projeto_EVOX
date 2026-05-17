<?php

namespace test\dao;

use dao\CompradorDAO;
use model\Comprador;
use PHPUnit\Framework\TestCase;

class CompradorDAOTest extends TestCase
{
    public function testSalvar()
    {
        $comprador = new Comprador();
        $comprador->setNome("João Silva");
        $comprador->setCpf("123.456.789-00");
        $comprador->setEmail("joao@email.com");
        $comprador->setIdade(25);

        $compradorInserido = CompradorDAO::salvar($comprador);

        $this->assertNotNull($compradorInserido->getId());
    }

    public function testListar()
    {
        $compradores = CompradorDAO::listar();
        foreach ($compradores as $comprador) {
            echo $comprador->getNome() . "\n";
        }

        $this->assertNotNull($compradores);
    }

    public function testBuscarId()
    {
        $comprador = new Comprador();
        $comprador->setNome("Maria Souza");
        $comprador->setCpf("987.654.321-00");
        $comprador->setEmail("maria@email.com");
        $comprador->setIdade(30);
        $comprador = CompradorDAO::salvar($comprador);

        $compradorBuscado = CompradorDAO::buscarId($comprador->getId());
        $this->assertNotNull($compradorBuscado->getId());
    }

    public function testAtualizar()
    {
        $comprador = new Comprador();
        $comprador->setNome("Pedro Lima");
        $comprador->setCpf("111.222.333-44");
        $comprador->setEmail("pedro@email.com");
        $comprador->setIdade(22);
        $comprador = CompradorDAO::salvar($comprador);

        $compradorEditar = CompradorDAO::buscarId($comprador->getId());
        $compradorEditar->setNome("Pedro Lima Editado");
        $compradorEditado = CompradorDAO::salvar($compradorEditar);

        $this->assertEquals("Pedro Lima Editado", $compradorEditado->getNome());
        $this->assertEquals($compradorEditado->getId(), $comprador->getId());
    }

    public function testDeletar()
    {
        $comprador = new Comprador();
        $comprador->setNome("Ana Deletar");
        $comprador->setCpf("555.666.777-88");
        $comprador->setEmail("ana@email.com");
        $comprador->setIdade(28);
        $comprador = CompradorDAO::salvar($comprador);

        $compradorDeletar = CompradorDAO::buscarId($comprador->getId());
        $idDeletar = $compradorDeletar->getId();
        CompradorDAO::deletar($compradorDeletar);

        $compradorDeletado = CompradorDAO::buscarId($idDeletar);
        $this->assertNull($compradorDeletado);
    }
}
