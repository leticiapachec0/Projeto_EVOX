<?php
namespace dao;
use model\Evento;
use model\GenericModel;
use utils\Conexao;

class EventoDAO extends GenericDAO{
    protected static $modelClass = Evento::class;

}
