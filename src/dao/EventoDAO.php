<?php
namespace dao;

use Exception;
use model\Evento;
use utils\Conexao;

class EventoDAO extends GenericDAO
{
    protected static $modelClass = Evento::class;

    // Magic Finder - busca por nome exato
    public static function buscarNome($nome)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Evento::class);
            return $repository->findByNome($nome);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar evento pelo nome. ' . $ex->getMessage());
        }
    }

    // findBy - busca por cidade
    public static function buscarCidade($cidade)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Evento::class);
            return $repository->findBy(['cidade' => $cidade]);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar evento pela cidade. ' . $ex->getMessage());
        }
    }

    // QueryBuilder - busca por nome parecido
    public static function buscarNomeParecidoQueryBuilder($nome)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Evento::class);
            $queryBuilder = $repository->createQueryBuilder('e');
            $queryBuilder
                ->where('e.nome LIKE :nome')
                ->setParameter('nome', '%' . $nome . '%');
            return $queryBuilder->getQuery()->getResult();
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar evento pelo nome. ' . $ex->getMessage());
        }
    }

    // DQL - busca eventos de uma cidade específica
    public static function buscarPorCidadeDQL($cidade)
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery('SELECT e FROM model\Evento e WHERE e.cidade LIKE :cidade');
            $query->setParameter('cidade', '%' . $cidade . '%');
            return $query->getResult();
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar evento pela cidade. ' . $ex->getMessage());
        }
    }

    public static function buscarPorDivulgador($divulgador)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Evento::class);
            return $repository->findBy(['divulgador' => $divulgador]);
        } catch (Exception $ex) {
            throw new Exception('Falha ao buscar eventos do divulgador. ' . $ex->getMessage());
        }
    }
}