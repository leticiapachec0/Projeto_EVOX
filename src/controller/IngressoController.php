<?php
namespace controller;

use Exception;
use dao\IngressoDAO;
use model\Ingresso;

class IngressoController
{
    public function listar()
    {
        try {
            $ingressos = IngressoDAO::listar();
        } catch (Exception $ex) {
            echo 'Falha ao listar os ingressos.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/lista-ingressos.php';
        }
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $ingresso = IngressoDAO::buscarId($id);
            if (empty($ingresso)) {
                throw new Exception('Ingresso não encontrado.');
            }
        } catch (Exception $ex) {
            echo 'Falha ao buscar o ingresso.' . $ex->getMessage();
        } finally {
            require __DIR__ . '/../view/visualizar-ingresso.php';
        }
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $ingresso = IngressoDAO::buscarId($id);
            if (empty($ingresso)) {
                throw new Exception('Ingresso não encontrado.');
            }
            IngressoDAO::deletar($ingresso);
        } catch (Exception $ex) {
            echo 'Falha ao remover o ingresso.' . $ex->getMessage();
        } finally {
            header('Location: ' . BASE_URL . '/ingressos');
            exit;
        }
    }
}
