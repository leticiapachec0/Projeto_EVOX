<?php
namespace controller;

use Exception;
use dao\IngressoDAO;
use dao\EventoDAO;
use model\Ingresso;
use utils\Sessao;

class IngressoController
{
    public function listar()
    {
        try {
            $ingressos = IngressoDAO::listar();
            Sessao::setUltimaPagina('ingressos');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao listar os ingressos.' . $ex->getMessage());
        } finally {
            require __DIR__ . '/../view/lista-ingressos.php';
        }
    }

    public function novo()
    {
        try {
            $ingresso = new Ingresso();
            $eventos = EventoDAO::listar();
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao abrir formulário.' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/ingressos');
        } finally {
            require __DIR__ . '/../view/cadastro-ingresso.php';
        }
    }

    public function cadastrar()
    {
        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);
            $evento_id = filter_input(INPUT_POST, 'evento_id', FILTER_SANITIZE_NUMBER_INT);

            $ingresso = $id ? IngressoDAO::buscarId($id) : new Ingresso();
            if (empty($ingresso))
                throw new Exception('Ingresso não encontrado.');

            $evento = $evento_id ? EventoDAO::buscarId($evento_id) : null;
            if (empty($evento))
                throw new Exception('Evento não encontrado.');

            $ingresso->setPreco((float) $preco);
            $ingresso->setQuantidade((int) $quantidade);
            $ingresso->setEvento($evento);

            IngressoDAO::salvar($ingresso);

            Sessao::setSucesso($id ? 'Ingresso atualizado com sucesso!' : 'Ingresso cadastrado com sucesso!');
            header('Location: ' . BASE_URL . '/ingressos');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao salvar ingresso: ' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/ingressos/novo');
        } finally {
            exit;
        }
    }

    public function editar(array $params)
    {
        try {
            $id = $params['id'];
            $ingresso = IngressoDAO::buscarId($id);
            if (empty($ingresso))
                throw new Exception('Ingresso não encontrado.');
            $eventos = EventoDAO::listar();
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao buscar ingresso: ' . $ex->getMessage());
        } finally {
            require __DIR__ . '/../view/cadastro-ingresso.php';
        }
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $ingresso = IngressoDAO::buscarId($id);
            if (empty($ingresso))
                throw new Exception('Ingresso não encontrado.');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao buscar o ingresso: ' . $ex->getMessage());
        } finally {
            require __DIR__ . '/../view/visualizar-ingresso.php';
        }
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $ingresso = IngressoDAO::buscarId($id);
            if (empty($ingresso))
                throw new Exception('Ingresso não encontrado.');
            IngressoDAO::deletar($ingresso);
            Sessao::setSucesso('Ingresso removido com sucesso!');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao remover o ingresso: ' . $ex->getMessage());
        } finally {
            header('Location: ' . BASE_URL . '/ingressos');
            exit;
        }
    }
}