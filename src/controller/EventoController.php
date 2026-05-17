<?php
namespace controller;

use Exception;
use dao\EventoDAO;
use model\Evento;

class EventoController
{
    public function listar()
    {
        try {
            $eventos = EventoDAO::listar();
        } catch (Exception $ex) {
            echo 'Falha ao listar os eventos.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/lista-eventos.php';
        }
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $evento = EventoDAO::buscarId($id);
            if (empty($evento)) {
                throw new Exception('Evento não encontrado.');
            }
        } catch (Exception $ex) {
            echo 'Falha ao buscar o evento.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/visualizar-evento.php';
        }
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $evento = EventoDAO::buscarId($id);
            if (empty($evento)) {
                throw new Exception('Evento não encontrado.');
            }
            EventoDAO::deletar($evento);
        } catch (Exception $ex) {
            echo 'Falha ao remover o evento.' . $ex->getMessage();
        } finally {
            header('Location: ' . BASE_URL . '/eventos');
            exit;
        }
    }
}
