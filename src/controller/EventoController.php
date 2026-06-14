<?php
namespace controller;

use DateTime;
use Exception;
use dao\EventoDAO;
use dao\DivulgadorDAO;
use model\Evento;
use utils\Sessao;

class EventoController
{
    public function listar()
    {
        try {
            $eventos = EventoDAO::listar();
            Sessao::setUltimaPagina('eventos');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao listar os eventos.' . $ex->getMessage());
        } finally {
            require __DIR__ . '/../view/lista-eventos.php';
        }
    }

    public function novo()
    {
        try {
            $evento = new Evento();
            $divulgadores = DivulgadorDAO::listar();
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao abrir formulário.' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/eventos');
        } finally {
            require __DIR__ . '/../view/cadastro-evento.php';
        }
    }

    public function cadastrar()
    {
        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
            $local = filter_input(INPUT_POST, 'local', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_evento = filter_input(INPUT_POST, 'data_evento', FILTER_SANITIZE_SPECIAL_CHARS);
            $divulgador_id = filter_input(INPUT_POST, 'divulgador_id', FILTER_SANITIZE_NUMBER_INT);

            $evento = $id ? EventoDAO::buscarId($id) : new Evento();
            if (empty($evento))
                throw new Exception('Evento não encontrado.');

            $divulgador = $divulgador_id ? DivulgadorDAO::buscarId($divulgador_id) : null;

            $evento->setNome($nome);
            $evento->setDescricao($descricao);
            $evento->setCidade($cidade);
            $evento->setLocal($local);
            $evento->setDataEvento(new DateTime($data_evento));
            $evento->setDivulgador($divulgador);

            EventoDAO::salvar($evento);

            Sessao::setSucesso($id ? 'Evento atualizado com sucesso!' : 'Evento cadastrado com sucesso!');
            header('Location: ' . BASE_URL . '/eventos');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao salvar evento: ' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/eventos/novo');
        } finally {
            exit;
        }
    }

    public function editar(array $params)
    {
        try {
            $id = $params['id'];
            $evento = EventoDAO::buscarId($id);
            if (empty($evento))
                throw new Exception('Evento não encontrado.');
            $divulgadores = DivulgadorDAO::listar();
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao buscar evento: ' . $ex->getMessage());
        } finally {
            require __DIR__ . '/../view/cadastro-evento.php';
        }
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $evento = EventoDAO::buscarId($id);
            if (empty($evento))
                throw new Exception('Evento não encontrado.');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao buscar o evento: ' . $ex->getMessage());
        } finally {
            require __DIR__ . '/../view/visualizar-evento.php';
        }
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $evento = EventoDAO::buscarId($id);
            if (empty($evento))
                throw new Exception('Evento não encontrado.');
            EventoDAO::deletar($evento);
            Sessao::setSucesso('Evento removido com sucesso!');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao remover o evento: ' . $ex->getMessage());
        } finally {
            header('Location: ' . BASE_URL . '/eventos');
            exit;
        }
    }
}