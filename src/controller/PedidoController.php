<?php
namespace controller;

use DateTime;
use Exception;
use dao\PedidoDAO;
use dao\CompradorDAO;
use dao\EventoDAO;
use model\Pedido;
use utils\Sessao;

class PedidoController
{
    public function listar()
    {
        try {
            $pedidos = PedidoDAO::listar();
            Sessao::setUltimaPagina('pedidos');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao listar os pedidos.' . $ex->getMessage());
        } finally {
            require __DIR__ . '/../view/lista-pedidos.php';
        }
    }

    public function novo(array $params = [])
    {
        try {
            Sessao::requireLogin();
            $evento_id = $params['evento_id'] ?? null;
            $pedido = new Pedido();
            $eventoSelecionado = $evento_id ? EventoDAO::buscarId($evento_id) : null;
            $compradores = CompradorDAO::listar();
            $eventos = EventoDAO::listar();
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao abrir formulário.' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/eventos');
        } finally {
            require __DIR__ . '/../view/checkout.php';
        }
    }

    public function cadastrar()
    {
        try {
            Sessao::requireLogin();
            $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS);
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);
            $total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $evento_id = filter_input(INPUT_POST, 'evento_id', FILTER_SANITIZE_NUMBER_INT);
            $comprador_email = filter_input(INPUT_POST, 'comprador_email', FILTER_SANITIZE_EMAIL);

            $evento = $evento_id ? EventoDAO::buscarId($evento_id) : null;
            if (empty($evento))
                throw new Exception('Evento não encontrado.');

            // Busca o comprador pelo email da sessão
            $compradores = CompradorDAO::listar();
            $comprador = null;
            foreach ($compradores as $c) {
                if ($c->getEmail() === $comprador_email) {
                    $comprador = $c;
                    break;
                }
            }

            if (empty($comprador))
                throw new Exception('Comprador não encontrado.');

            $pedido = new Pedido();
            $pedido->setData(new DateTime($data));
            $pedido->setQuantidade((int) $quantidade);
            $pedido->setTotal((float) $total);
            $pedido->setComprador($comprador);
            $pedido->setEvento($evento);

            PedidoDAO::salvar($pedido);

            Sessao::setSucesso('Compra realizada com sucesso!');
            header('Location: ' . BASE_URL . '/pedidos/' . $pedido->getId() . '/recibo');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao realizar compra: ' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/eventos');
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
            Sessao::setErro('Falha ao buscar pedido: ' . $ex->getMessage());
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
            Sessao::setErro('Falha ao buscar o pedido: ' . $ex->getMessage());
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
            Sessao::setSucesso('Pedido removido com sucesso!');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao remover o pedido: ' . $ex->getMessage());
        } finally {
            header('Location: ' . BASE_URL . '/pedidos');
            exit;
        }
    }

    public function recibo(array $params)
    {
        try {
            Sessao::requireLogin();
            $id = $params['id'];
            $pedido = PedidoDAO::buscarId($id);
            if (empty($pedido))
                throw new Exception('Pedido não encontrado.');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao buscar recibo: ' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/eventos');
            exit;
        }
        require __DIR__ . '/../view/recibo.php';
    }
}