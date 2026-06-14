<?php
namespace controller;

use Exception;
use dao\DivulgadorDAO;
use model\Divulgador;
use utils\Sessao;

class DivulgadorController
{
    public function listar()
    {
        try {
            $divulgadores = DivulgadorDAO::listar();
            Sessao::setUltimaPagina('divulgadores');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao listar os divulgadores.' . $ex->getMessage());
        } finally {
            require __DIR__ . '/../view/lista-divulgadores.php';
        }
    }

    public function novo()
    {
        try {
            $divulgador = new Divulgador();
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao abrir formulário.' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/divulgadores');
        } finally {
            require __DIR__ . '/../view/cadastro-divulgador.php';
        }
    }

    public function cadastrar()
    {
        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

            $divulgador = $id ? DivulgadorDAO::buscarId($id) : new Divulgador();
            if (empty($divulgador))
                throw new Exception('Divulgador não encontrado.');

            $divulgador->setNome($nome);
            $divulgador->setCnpj($cnpj);
            $divulgador->setEmail($email);

            DivulgadorDAO::salvar($divulgador);

            Sessao::setSucesso($id ? 'Divulgador atualizado com sucesso!' : 'Divulgador cadastrado com sucesso!');
            header('Location: ' . BASE_URL . '/divulgadores');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao salvar divulgador: ' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/divulgadores/novo');
        } finally {
            exit;
        }
    }

    public function editar(array $params)
    {
        try {
            $id = $params['id'];
            $divulgador = DivulgadorDAO::buscarId($id);
            if (empty($divulgador))
                throw new Exception('Divulgador não encontrado.');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao buscar divulgador: ' . $ex->getMessage());
        } finally {
            require __DIR__ . '/../view/cadastro-divulgador.php';
        }
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $divulgador = DivulgadorDAO::buscarId($id);
            if (empty($divulgador))
                throw new Exception('Divulgador não encontrado.');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao buscar o divulgador: ' . $ex->getMessage());
        } finally {
            require __DIR__ . '/../view/visualizar-divulgador.php';
        }
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $divulgador = DivulgadorDAO::buscarId($id);
            if (empty($divulgador))
                throw new Exception('Divulgador não encontrado.');
            DivulgadorDAO::deletar($divulgador);
            Sessao::setSucesso('Divulgador removido com sucesso!');
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao remover o divulgador: ' . $ex->getMessage());
        } finally {
            header('Location: ' . BASE_URL . '/divulgadores');
            exit;
        }
    }
}