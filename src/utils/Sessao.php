<?php
namespace utils;

class Sessao
{
    // Salva uma mensagem de sucesso na sessão
    public static function setSucesso($mensagem)
    {
        $_SESSION['mensagem_sucesso'] = $mensagem;
    }

    // Salva uma mensagem de erro na sessão
    public static function setErro($mensagem)
    {
        $_SESSION['mensagem_erro'] = $mensagem;
    }

    // Retorna e limpa a mensagem de sucesso
    public static function getSucesso()
    {
        $mensagem = $_SESSION['mensagem_sucesso'] ?? null;
        unset($_SESSION['mensagem_sucesso']);
        return $mensagem;
    }

    // Retorna e limpa a mensagem de erro
    public static function getErro()
    {
        $mensagem = $_SESSION['mensagem_erro'] ?? null;
        unset($_SESSION['mensagem_erro']);
        return $mensagem;
    }

    // Salva a última página visitada em cookie
    public static function setUltimaPagina($pagina)
    {
        setcookie('ultima_pagina', $pagina, time() + (86400 * 7), '/'); // 7 dias
    }

    // Retorna a última página visitada
    public static function getUltimaPagina()
    {
        return $_COOKIE['ultima_pagina'] ?? null;
    }

    // Verifica se está logado
    public static function estaLogado(): bool
    {
        return isset($_SESSION['usuario_id']);
    }

// Verifica se é admin
    public static function eAdmin(): bool
    {
        return isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'admin';
    }

// Verifica se é divulgador
    public static function eDivulgador(): bool
    {
        return isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'divulgador';
    }

// Verifica se é comprador
    public static function eComprador(): bool
    {
        return isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'comprador';
    }

// Redireciona se não tiver permissão
    public static function requireAdmin()
    {
        if (!self::eAdmin()) {
            self::setErro('Acesso negado. Faça login como administrador.');
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public static function requireDivulgadorOuAdmin()
    {
        if (!self::eAdmin() && !self::eDivulgador()) {
            self::setErro('Acesso negado. Faça login para continuar.');
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public static function requireLogin()
    {
        if (!self::estaLogado()) {
            self::setErro('Faça login para continuar.');
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }
}