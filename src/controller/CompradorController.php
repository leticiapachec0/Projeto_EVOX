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

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $comprador = CompradorDAO::buscarId($id);
            if (empty($comprador)) {
                throw new Exception('Comprador não encontrado.');
            }
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
            if (empty($comprador)) {
                throw new Exception('Comprador não encontrado.');
            }
            CompradorDAO::deletar($comprador);
        } catch (Exception $ex) {
            echo 'Falha ao remover o comprador.' . $ex->getMessage();
        } finally {
            header('Location: ' . BASE_URL . '/compradores');
            exit;
        }
    }
}
