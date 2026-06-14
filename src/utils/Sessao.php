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
}