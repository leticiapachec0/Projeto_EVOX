<?php
namespace dao;

use Exception;
use model\Comprador;
use utils\Conexao;

class CompradorDAO extends GenericDAO
{
    protected static $modelClass = Comprador::class;

    // Magic Finder - busca por nome exato
    public static function buscarNome($nome)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Comprador::class);
            return $repository->findByNome($nome);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar comprador pelo nome. ' . $ex->getMessage());
        }
    }

    // findBy - busca por email
    public static function buscarEmail($email)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Comprador::class);
            return $repository->findBy(['email' => $email]);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar comprador pelo email. ' . $ex->getMessage());
        }
    }

    // QueryBuilder - busca por nome parecido
    public static function buscarNomeParecidoQueryBuilder($nome)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Comprador::class);
            $queryBuilder = $repository->createQueryBuilder('c');
            $queryBuilder
                ->where('c.nome LIKE :nome')
                ->setParameter('nome', '%' . $nome . '%');
            return $queryBuilder->getQuery()->getResult();
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar comprador pelo nome. ' . $ex->getMessage());
        }
    }

    // DQL - busca compradores por idade mínima
    public static function buscarPorIdadeMinimaDQL($idade)
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery('SELECT c FROM model\Comprador c WHERE c.idade >= :idade');
            $query->setParameter('idade', $idade);
            return $query->getResult();
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar comprador pela idade. ' . $ex->getMessage());
        }
    }
}