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

    public function testBuscarNome()
    {
        $comprador = new Comprador();
        $comprador->setNome("Carlos Teste");
        $comprador->setCpf("222.333.444-55");
        $comprador->setEmail("carlos@email.com");
        $comprador->setIdade(35);
        CompradorDAO::salvar($comprador);

        $compradores = CompradorDAO::buscarNome("Carlos Teste");
        $this->assertNotEmpty($compradores);
    }

    public function testBuscarEmail()
    {
        $comprador = new Comprador();
        $comprador->setNome("Lucia Email");
        $comprador->setCpf("333.444.555-66");
        $comprador->setEmail("lucia@email.com");
        $comprador->setIdade(40);
        CompradorDAO::salvar($comprador);

        $compradores = CompradorDAO::buscarEmail("lucia@email.com");
        $this->assertNotEmpty($compradores);
    }

    public function testBuscarNomeParecidoQueryBuilder()
    {
        $comprador = new Comprador();
        $comprador->setNome("Roberto Query");
        $comprador->setCpf("444.555.666-77");
        $comprador->setEmail("roberto@email.com");
        $comprador->setIdade(29);
        CompradorDAO::salvar($comprador);

        $compradores = CompradorDAO::buscarNomeParecidoQueryBuilder("Roberto");
        $this->assertNotEmpty($compradores);
    }

    public function testBuscarPorIdadeMinimaDQL()
    {
        $comprador = new Comprador();
        $comprador->setNome("Adulto DQL");
        $comprador->setCpf("555.666.777-99");
        $comprador->setEmail("adulto@email.com");
        $comprador->setIdade(18);
        CompradorDAO::salvar($comprador);

        $compradores = CompradorDAO::buscarPorIdadeMinimaDQL(18);
        $this->assertNotEmpty($compradores);
    }
}