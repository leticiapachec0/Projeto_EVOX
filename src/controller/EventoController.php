<?php
namespace controller;

use model\Evento;
use dao\EventoDAO;

class EventoController
{
    public function salvar($nome, $descricao, $cidade, $local, $data)
    {
        $evento = new Evento();
        $evento->setNome($nome);
        $evento->setDescricao($descricao);
        $evento->setCidade($cidade);
        $evento->setLocal($local);
        $evento->setDataEvento(new \DateTime($data));

        EventoDAO::salvar($evento);
    }

    public function listar()
    {
        return EventoDAO::listar();
    }

    public function deletar($evento)
    {
        EventoDAO::deletar($evento);
    }

    public function atualizar($evento)
    {
        EventoDAO::atualizar($evento);
    }
}