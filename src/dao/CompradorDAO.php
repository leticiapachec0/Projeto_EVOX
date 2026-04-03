<?php

namespace dao;

use model\Evento;
use model\GenericModel;
use utils\Conexao;

class CompradorDAO extends GenericDAO
{
    protected static $modelClass = Evento::class;

}
