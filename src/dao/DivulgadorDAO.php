<?php

namespace dao;

use model\Evento;
use model\GenericModel;
use utils\Conexao;

class DivulgadorDAO extends GenericDAO
{
    protected static $modelClass = Evento::class;

}
