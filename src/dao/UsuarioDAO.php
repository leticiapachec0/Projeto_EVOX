<?php
namespace dao;

use Exception;
use model\Usuario;
use utils\Conexao;

class UsuarioDAO extends GenericDAO
{
    protected static $modelClass = Usuario::class;

    public static function buscarEmail($email)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Usuario::class);
            return $repository->findOneBy(['email' => $email]);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar usuário pelo email. ' . $ex->getMessage());
        }
    }
}