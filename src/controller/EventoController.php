<?php
namespace controller;

use DateTime;
use Exception;
use dao\EventoDAO;
use dao\DivulgadorDAO;
use dao\IngressoDAO;
use model\Evento;
use model\Ingresso;
use utils\Sessao;
use utils\FileUpload;

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

    public function inicio()
    {
        try {
            $eventos = EventoDAO::listar();
        } catch (Exception $ex) {
            $eventos = [];
        } finally {
            require __DIR__ . '/../view/inicio.php';
        }
    }

    public function novo()
    {
        try {
            Sessao::requireDivulgadorOuAdmin();
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
            Sessao::requireDivulgadorOuAdmin();
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

            // Upload de imagem
            if (!empty($_FILES['imagem_evento']['tmp_name'])) {
                if (!empty($evento->getUrlImagem())) {
                    $imagemAntiga = $evento->getUrlImagem();
                }
                $uploadResult = FileUpload::uploadImagem(
                    'eventos',
                    $_FILES['imagem_evento']['tmp_name'],
                    uniqid('imagem_evento_')
                );
                $evento->setUrlImagem($uploadResult['secure_url']);
            }


            EventoDAO::salvar($evento);

            // Salva o ingresso vinculado ao evento
            $preco_ingresso = filter_input(INPUT_POST, 'preco_ingresso', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if (!empty($preco_ingresso)) {
                // Se já tem ingresso, atualiza. Se não, cria novo.
                $ingressos = $evento->getIngressos();
                if ($ingressos && count($ingressos) > 0) {
                    $ingresso = $ingressos[0];
                } else {
                    $ingresso = new \model\Ingresso();
                    $ingresso->setEvento($evento);
                }
                $ingresso->setPreco((float) $preco_ingresso);
                $ingresso->setQuantidade(100); // quantidade padrão
                \dao\IngressoDAO::salvar($ingresso);
            }



            if (!empty($imagemAntiga)) {
                FileUpload::deletarImagem('eventos', $imagemAntiga);
            }

            Sessao::setSucesso($id ? 'Evento atualizado com sucesso!' : 'Evento cadastrado com sucesso!');
            header('Location: ' . BASE_URL . '/eventos');
        } catch (Exception $ex) {
            if (!empty($uploadResult['secure_url'])) {
                FileUpload::deletarImagem('eventos', $uploadResult['secure_url']);
            }
            Sessao::setErro('Falha ao salvar evento: ' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/eventos/novo');
        } finally {
            exit;
        }
    }

    public function editar(array $params)
    {
        try {
            Sessao::requireDivulgadorOuAdmin();
            $id = $params['id'];
            $evento = EventoDAO::buscarId($id);
            if (empty($evento))
                throw new Exception('Evento não encontrado.');

            // Verifica se o divulgador é dono do evento
            if (Sessao::eDivulgador()) {
                $divulgadorId = $_SESSION['divulgador_id'] ?? null;
                if ($evento->getDivulgador() === null || $evento->getDivulgador()->getId() != $divulgadorId) {
                    throw new Exception('Você não tem permissão para editar este evento.');
                }
            }

            $divulgadores = DivulgadorDAO::listar();
        } catch (Exception $ex) {
            Sessao::setErro('Falha ao buscar evento: ' . $ex->getMessage());
            header('Location: ' . BASE_URL . '/eventos');
            exit;
        }
        require __DIR__ . '/../view/cadastro-evento.php';
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
            Sessao::requireDivulgadorOuAdmin();
            $id = $params['id'];
            $evento = EventoDAO::buscarId($id);
            if (empty($evento))
                throw new Exception('Evento não encontrado.');

            // Verifica se o divulgador é dono do evento
            if (Sessao::eDivulgador()) {
                $divulgadorId = $_SESSION['divulgador_id'] ?? null;
                if ($evento->getDivulgador() === null || $evento->getDivulgador()->getId() != $divulgadorId) {
                    throw new Exception('Você não tem permissão para remover este evento.');
                }
            }

            if (!empty($evento->getUrlImagem())) {
                FileUpload::deletarImagem('eventos', $evento->getUrlImagem());
            }

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