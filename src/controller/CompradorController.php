<?php
namespace controller;

use Exception;
use dao\CompradorDAO;
use model\Comprador;

class CompradorController
{
    public function listar()
    {
        try {
            $compradores = CompradorDAO::listar();
        } catch (Exception $ex) {
            echo 'Falha ao listar os compradores.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/lista-compradores.php';
        }
    }

    public function novo()
    {
        try {
            $comprador = new Comprador();
        } catch (Exception $ex) {
            echo 'Falha ao abrir formulário.' . $ex->getMessage();
            header('Location: ' . BASE_URL . '/compradores');
        } finally {
            require __DIR__ . '/../view/cadastro-comprador.php';
        }
    }

    public function cadastrar()
    {
        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);

            $comprador = $id ? CompradorDAO::buscarId($id) : new Comprador();
            if (empty($comprador))
                throw new Exception('Comprador não encontrado.');

            $comprador->setNome($nome);
            $comprador->setCpf($cpf);
            $comprador->setEmail($email);
            $comprador->setIdade((int) $idade);

            CompradorDAO::salvar($comprador);

            header('Location: ' . BASE_URL . '/compradores');
        } catch (Exception $ex) {
            echo 'Falha ao salvar comprador.' . $ex->getMessage();
            header('Location: ' . BASE_URL . '/compradores/novo');
        } finally {
            exit;
        }
    }

    public function editar(array $params)
    {
        try {
            $id = $params['id'];
            $comprador = CompradorDAO::buscarId($id);
            if (empty($comprador))
                throw new Exception('Comprador não encontrado.');
        } catch (Exception $ex) {
            echo 'Falha ao buscar comprador.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/cadastro-comprador.php';
        }
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $comprador = CompradorDAO::buscarId($id);
            if (empty($comprador))
                throw new Exception('Comprador não encontrado.');
        } catch (Exception $ex) {
            echo 'Falha ao buscar o comprador.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/visualizar-comprador.php';
        }
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $comprador = CompradorDAO::buscarId($id);
            if (empty($comprador))
                throw new Exception('Comprador não encontrado.');
            CompradorDAO::deletar($comprador);
        } catch (Exception $ex) {
            echo 'Falha ao remover o comprador.' . $ex->getMessage();
        } finally {
            header('Location: ' . BASE_URL . '/compradores');
            exit;
        }
    }
}