<?php
namespace controller;

use Exception;
use dao\UsuarioDAO;
use dao\CompradorDAO;
use dao\DivulgadorDAO;
use model\Usuario;
use model\Comprador;
use model\Divulgador;
use utils\Sessao;

class AutenticacaoController
{
    public function login()
    {
        require __DIR__ . '/../view/login.php';
    }

    public function autenticar()
    {
        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

            $usuario = UsuarioDAO::buscarEmail($email);

            if (empty($usuario) || !password_verify($senha, $usuario->getSenha())) {
                throw new Exception('Email ou senha inválidos.');
            }

            $_SESSION['usuario_id'] = $usuario->getId();
            $_SESSION['usuario_nome'] = $usuario->getNome();
            $_SESSION['usuario_email'] = $usuario->getEmail();
            $_SESSION['usuario_role'] = $usuario->getRole();

            Sessao::setSucesso('Bem-vindo, ' . $usuario->getNome() . '!');
            header('Location: ' . BASE_URL . '/');

        } catch (Exception $ex) {
            Sessao::setErro($ex->getMessage());
            header('Location: ' . BASE_URL . '/login');
        } finally {
            exit;
        }
    }

    public function cadastrar()
    {
        require __DIR__ . '/../view/cadastro-usuario.php';
    }

    public function salvarCadastro()
    {
        try {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);

            // Verifica se email já existe
            $usuarioExistente = UsuarioDAO::buscarEmail($email);
            if (!empty($usuarioExistente)) {
                throw new Exception('Este email já está cadastrado.');
            }

            // Cria o usuário base
            $usuario = new Usuario();
            $usuario->setNome($nome);
            $usuario->setEmail($email);
            $usuario->setSenha(password_hash($senha, PASSWORD_DEFAULT));
            $usuario->setRole($role);
            UsuarioDAO::salvar($usuario);

            // Se for comprador, cria também o comprador
            if ($role === 'comprador') {
                $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
                $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);

                $comprador = new Comprador();
                $comprador->setNome($nome);
                $comprador->setCpf($cpf);
                $comprador->setEmail($email);
                $comprador->setIdade((int) $idade);
                CompradorDAO::salvar($comprador);
            }

            // Se for divulgador, cria também o divulgador
            if ($role === 'divulgador') {
                $cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_SPECIAL_CHARS);

                $divulgador = new Divulgador();
                $divulgador->setNome($nome);
                $divulgador->setEmail($email);
                $divulgador->setCnpj($cnpj);
                DivulgadorDAO::salvar($divulgador);
            }

            Sessao::setSucesso('Cadastro realizado com sucesso! Faça login para continuar.');
            header('Location: ' . BASE_URL . '/login');

        } catch (Exception $ex) {
            Sessao::setErro('Falha ao cadastrar: ' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/cadastro');
        } finally {
            exit;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/');
        exit;
    }
}