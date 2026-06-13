<?php
namespace dao;

use Exception;
use model\Pedido;
use utils\Conexao;

class PedidoDAO extends GenericDAO
{
    protected static $modelClass = Pedido::class;

    // Magic Finder - busca por quantidade exata
    public static function buscarQuantidade($quantidade)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Pedido::class);
            return $repository->findByQuantidade($quantidade);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar pedido pela quantidade. ' . $ex->getMessage());
        }
    }

    // findBy - busca por comprador
    public static function buscarPorComprador($comprador)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Pedido::class);
            return $repository->findBy(['comprador' => $comprador]);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar pedido por comprador. ' . $ex->getMessage());
        }
    }

    // QueryBuilder - busca pedidos com total acima de um valor mínimo
    public static function buscarPorTotalMinimoQueryBuilder($total)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Pedido::class);
            $queryBuilder = $repository->createQueryBuilder('p');
            $queryBuilder
                ->where('p.total >= :total')
                ->setParameter('total', $total);
            return $queryBuilder->getQuery()->getResult();
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar pedido pelo total. ' . $ex->getMessage());
        }
    }

    // DQL - busca pedidos por evento
    public static function buscarPorEventoDQL($evento)
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery('SELECT p FROM model\Pedido p WHERE p.evento = :evento');
            $query->setParameter('evento', $evento);
            return $query->getResult();
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar pedido por evento. ' . $ex->getMessage());
        }
    }
}