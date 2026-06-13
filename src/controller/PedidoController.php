<?php
namespace controller;

use DateTime;
use Exception;
use dao\PedidoDAO;
use dao\CompradorDAO;
use dao\EventoDAO;
use model\Pedido;

class PedidoController
{
    public function listar()
    {
        try {
            $pedidos = PedidoDAO::listar();
        } catch (Exception $ex) {
            echo 'Falha ao listar os pedidos.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/lista-pedidos.php';
        }
    }

    public function novo()
    {
        try {
            $pedido = new Pedido();
            $compradores = CompradorDAO::listar();
            $eventos = EventoDAO::listar();
        } catch (Exception $ex) {
            echo 'Falha ao abrir formulário.' . $ex->getMessage();
            header('Location: ' . BASE_URL . '/pedidos');
        } finally {
            require __DIR__ . '/../view/cadastro-pedido.php';
        }
    }

    public function cadastrar()
    {
        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS);
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);
            $total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $comprador_id = filter_input(INPUT_POST, 'comprador_id', FILTER_SANITIZE_NUMBER_INT);
            $evento_id = filter_input(INPUT_POST, 'evento_id', FILTER_SANITIZE_NUMBER_INT);

            $pedido = $id ? PedidoDAO::buscarId($id) : new Pedido();
            if (empty($pedido))
                throw new Exception('Pedido não encontrado.');

            $comprador = $comprador_id ? CompradorDAO::buscarId($comprador_id) : null;
            if (empty($comprador))
                throw new Exception('Comprador não encontrado.');

            $evento = $evento_id ? EventoDAO::buscarId($evento_id) : null;
            if (empty($evento))
                throw new Exception('Evento não encontrado.');

            $pedido->setData(new DateTime($data));
            $pedido->setQuantidade((int) $quantidade);
            $pedido->setTotal((float) $total);
            $pedido->setComprador($comprador);
            $pedido->setEvento($evento);

            PedidoDAO::salvar($pedido);

            header('Location: ' . BASE_URL . '/pedidos');
        } catch (Exception $ex) {
            echo 'Falha ao salvar pedido.' . $ex->getMessage();
            header('Location: ' . BASE_URL . '/pedidos/novo');
        } finally {
            exit;
        }
    }

    public function editar(array $params)
    {
        try {
            $id = $params['id'];
            $pedido = PedidoDAO::buscarId($id);
            if (empty($pedido))
                throw new Exception('Pedido não encontrado.');
            $compradores = CompradorDAO::listar();
            $eventos = EventoDAO::listar();
        } catch (Exception $ex) {
            echo 'Falha ao buscar pedido.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/cadastro-pedido.php';
        }
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $pedido = PedidoDAO::buscarId($id);
            if (empty($pedido))
                throw new Exception('Pedido não encontrado.');
        } catch (Exception $ex) {
            echo 'Falha ao buscar o pedido.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/visualizar-pedido.php';
        }
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $pedido = PedidoDAO::buscarId($id);
            if (empty($pedido))
                throw new Exception('Pedido não encontrado.');
            PedidoDAO::deletar($pedido);
        } catch (Exception $ex) {
            echo 'Falha ao remover o pedido.' . $ex->getMessage();
        } finally {
            header('Location: ' . BASE_URL . '/pedidos');
            exit;
        }
    }
}