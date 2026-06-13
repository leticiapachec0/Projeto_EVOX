<?php
namespace dao;

use Exception;
use model\Divulgador;
use utils\Conexao;

class DivulgadorDAO extends GenericDAO
{
    protected static $modelClass = Divulgador::class;

    // Magic Finder - busca por nome exato
    public static function buscarNome($nome)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Divulgador::class);
            return $repository->findByNome($nome);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar divulgador pelo nome. ' . $ex->getMessage());
        }
    }

    // findBy - busca por email
    public static function buscarEmail($email)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Divulgador::class);
            return $repository->findBy(['email' => $email]);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar divulgador pelo email. ' . $ex->getMessage());
        }
    }

    // QueryBuilder - busca por nome parecido
    public static function buscarNomeParecidoQueryBuilder($nome)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Divulgador::class);
            $queryBuilder = $repository->createQueryBuilder('d');
            $queryBuilder
                ->where('d.nome LIKE :nome')
                ->setParameter('nome', '%' . $nome . '%');
            return $queryBuilder->getQuery()->getResult();
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar divulgador pelo nome. ' . $ex->getMessage());
        }
    }

    // DQL - busca por CNPJ
    public static function buscarPorCnpjDQL($cnpj)
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery('SELECT d FROM model\Divulgador d WHERE d.cnpj = :cnpj');
            $query->setParameter('cnpj', $cnpj);
            return $query->getResult();
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar divulgador pelo CNPJ. ' . $ex->getMessage());
        }
    }
}