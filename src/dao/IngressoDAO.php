<?php
namespace dao;

use Exception;
use model\Ingresso;
use utils\Conexao;

class IngressoDAO extends GenericDAO
{
    protected static $modelClass = Ingresso::class;

    // Magic Finder - busca por quantidade exata
    public static function buscarQuantidade($quantidade)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Ingresso::class);
            return $repository->findByQuantidade($quantidade);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar ingresso pela quantidade. ' . $ex->getMessage());
        }
    }

    // findBy - busca por evento
    public static function buscarPorEvento($evento)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Ingresso::class);
            return $repository->findBy(['evento' => $evento]);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar ingresso por evento. ' . $ex->getMessage());
        }
    }

    // QueryBuilder - busca ingressos com preço até um valor máximo
    public static function buscarPorPrecoMaximoQueryBuilder($preco)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Ingresso::class);
            $queryBuilder = $repository->createQueryBuilder('i');
            $queryBuilder
                ->where('i.preco <= :preco')
                ->setParameter('preco', $preco);
            return $queryBuilder->getQuery()->getResult();
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar ingresso pelo preço. ' . $ex->getMessage());
        }
    }

    // DQL - busca ingressos com quantidade disponível acima de um mínimo
    public static function buscarPorQuantidadeMinimaDQL($quantidade)
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery('SELECT i FROM model\Ingresso i WHERE i.quantidade >= :quantidade');
            $query->setParameter('quantidade', $quantidade);
            return $query->getResult();
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar ingresso pela quantidade. ' . $ex->getMessage());
        }
    }
}