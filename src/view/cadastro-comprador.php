<?php /** @var \model\Comprador $comprador */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Cadastro de Comprador</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <h1><?= $comprador->getId() ? 'Editar Comprador' : 'Cadastrar Comprador' ?></h1>

    <form id="formCadastroComprador" action="<?= BASE_URL . '/compradores/cadastrar' ?>" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($comprador->getId() ?? '') ?>">

        <div class="row mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input id="nome" name="nome" type="text" class="form-control"
                   value="<?= htmlspecialchars($comprador->getNome() ?? '') ?>">
        </div>

        <div class="row mb-3">
            <label for="cpf" class="form-label">CPF:</label>
            <input id="cpf" name="cpf" type="text" class="form-control"
                   value="<?= htmlspecialchars($comprador->getCpf() ?? '') ?>">
        </div>

        <div class="row mb-3">
            <label for="email" class="form-label">Email:</label>
            <input id="email" name="email" type="email" class="form-control"
                   value="<?= htmlspecialchars($comprador->getEmail() ?? '') ?>">
        </div>

        <div class="row mb-3">
            <label for="idade" class="form-label">Idade:</label>
            <input id="idade" name="idade" type="number" class="form-control"
                   value="<?= $comprador->getIdade() ?? '' ?>">
        </div>

        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="<?= BASE_URL . '/compradores' ?>" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>