<?php
namespace controller;

use Exception;
use dao\DivulgadorDAO;
use model\Divulgador;

class DivulgadorController
{
    public function listar()
    {
        try {
            $divulgadores = DivulgadorDAO::listar();
        } catch (Exception $ex) {
            echo 'Falha ao listar os divulgadores.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/lista-divulgadores.php';
        }
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $divulgador = DivulgadorDAO::buscarId($id);
            if (empty($divulgador)) {
                throw new Exception('Divulgador não encontrado.');
            }
        } catch (Exception $ex) {
            echo 'Falha ao buscar o divulgador.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/visualizar-divulgador.php';
        }
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $divulgador = DivulgadorDAO::buscarId($id);
            if (empty($divulgador)) {
                throw new Exception('Divulgador não encontrado.');
            }
            DivulgadorDAO::deletar($divulgador);
        } catch (Exception $ex) {
            echo 'Falha ao remover o divulgador.' . $ex->getMessage();
        } finally {
            header('Location: ' . BASE_URL . '/divulgadores');
            exit;
        }
    }
}
