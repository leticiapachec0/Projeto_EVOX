<?php /** @var \model\Divulgador $divulgador */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Cadastro de Divulgador</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <h1><?= $divulgador->getId() ? 'Editar Divulgador' : 'Cadastrar Divulgador' ?></h1>

    <form id="formCadastroDivulgador" action="<?= BASE_URL . '/divulgadores/cadastrar' ?>" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($divulgador->getId() ?? '') ?>">

        <div class="row mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input id="nome" name="nome" type="text" class="form-control"
                   value="<?= htmlspecialchars($divulgador->getNome() ?? '') ?>">
        </div>

        <div class="row mb-3">
            <label for="cnpj" class="form-label">CNPJ:</label>
            <input id="cnpj" name="cnpj" type="text" class="form-control"
                   value="<?= htmlspecialchars($divulgador->getCnpj() ?? '') ?>">
        </div>

        <div class="row mb-3">
            <label for="email" class="form-label">Email:</label>
            <input id="email" name="email" type="email" class="form-control"
                   value="<?= htmlspecialchars($divulgador->getEmail() ?? '') ?>">
        </div>

        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="<?= BASE_URL . '/divulgadores' ?>" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>