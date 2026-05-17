<?php
namespace controller;

use Exception;
use dao\PedidoDAO;
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

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $pedido = PedidoDAO::buscarId($id);
            if (empty($pedido)) {
                throw new Exception('Pedido não encontrado.');
            }
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
            if (empty($pedido)) {
                throw new Exception('Pedido não encontrado.');
            }
            PedidoDAO::deletar($pedido);
        } catch (Exception $ex) {
            echo 'Falha ao remover o pedido.' . $ex->getMessage();
        } finally {
            header('Location: ' . BASE_URL . '/pedidos');
            exit;
        }
    }
}
