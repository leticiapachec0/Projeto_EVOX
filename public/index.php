<?php

session_start();

require "../vendor/autoload.php";

define('BASE_URL', '');

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    $r->get('/', 'EventoController@inicio');
    $r->get('/inicio', 'EventoController@inicio');

    // Autenticação
    $r->get('/login', 'AutenticacaoController@login');
    $r->post('/autenticar', 'AutenticacaoController@autenticar');
    $r->get('/cadastro', 'AutenticacaoController@cadastrar');
    $r->post('/salvar-cadastro', 'AutenticacaoController@salvarCadastro');
    $r->get('/logout', 'AutenticacaoController@logout');

    // Eventos
    $r->get('/eventos', 'EventoController@listar');
    $r->get('/eventos/novo', 'EventoController@novo');
    $r->get('/eventos/{id}/editar', 'EventoController@editar');
    $r->get('/eventos/{id}', 'EventoController@buscar');
    $r->post('/eventos/cadastrar', 'EventoController@cadastrar');
    $r->post('/eventos/{id}/remover', 'EventoController@remover');

    // Compradores
    $r->get('/compradores', 'CompradorController@listar');
    $r->get('/compradores/novo', 'CompradorController@novo');
    $r->get('/compradores/{id}/editar', 'CompradorController@editar');
    $r->get('/compradores/{id}', 'CompradorController@buscar');
    $r->post('/compradores/cadastrar', 'CompradorController@cadastrar');
    $r->post('/compradores/{id}/remover', 'CompradorController@remover');
    $r->get('/perfil', 'AutenticacaoController@perfil');

    // Ingressos
    $r->get('/ingressos', 'IngressoController@listar');
    $r->get('/ingressos/novo', 'IngressoController@novo');
    $r->get('/ingressos/{id}/editar', 'IngressoController@editar');
    $r->get('/ingressos/{id}', 'IngressoController@buscar');
    $r->post('/ingressos/cadastrar', 'IngressoController@cadastrar');
    $r->post('/ingressos/{id}/remover', 'IngressoController@remover');

    // Pedidos
    $r->get('/pedidos', 'PedidoController@listar');
    $r->get('/pedidos/novo/{evento_id}', 'PedidoController@novo');
    $r->get('/pedidos/editar/{id}', 'PedidoController@editar');
    $r->get('/pedidos/ver/{id}', 'PedidoController@buscar');
    $r->post('/pedidos/cadastrar', 'PedidoController@cadastrar');
    $r->post('/pedidos/remover/{id}', 'PedidoController@remover');

    // Divulgadores
    $r->get('/divulgadores', 'DivulgadorController@listar');
    $r->get('/divulgadores/novo', 'DivulgadorController@novo');
    $r->get('/divulgadores/{id}/editar', 'DivulgadorController@editar');
    $r->get('/divulgadores/{id}', 'DivulgadorController@buscar');
    $r->post('/divulgadores/cadastrar', 'DivulgadorController@cadastrar');
    $r->post('/divulgadores/{id}/remover', 'DivulgadorController@remover');
    $r->get('/perfil-divulgador', 'AutenticacaoController@perfilDivulgador');

});

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$basePath = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
$uri = substr($uri, strlen($basePath)) ?: '/';
$method = $_SERVER['REQUEST_METHOD'];
$route = $dispatcher->dispatch($method, $uri);

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo "Rota não encontrada";
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo "Método não permitido";
        break;

    case FastRoute\Dispatcher::FOUND:
        [$controllerClass, $action] = explode('@', $route[1]);
        $params = $route[2];
        $controllerNamespace = "controller\\{$controllerClass}";
        $controller = new $controllerNamespace();
        $controller->$action($params);
        break;
}