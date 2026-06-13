<?php /**
 * @var \model\Ingresso $ingresso
 * @var \model\Evento[] $eventos
 */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Cadastro de Ingresso</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <h1><?= $ingresso->getId() ? 'Editar Ingresso' : 'Cadastrar Ingresso' ?></h1>

    <form id="formCadastroIngresso" action="<?= BASE_URL . '/ingressos/cadastrar' ?>" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($ingresso->getId() ?? '') ?>">

        <div class="row mb-3">
            <label for="evento_id" class="form-label">Evento:</label>
            <select id="evento_id" name="evento_id" class="form-control">
                <option value="">Selecione um evento</option>
                <?php foreach ($eventos as $evento) : ?>
                    <option value="<?= $evento->getId() ?>"
                        <?= $evento->getId() == $ingresso->getEvento()?->getId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($evento->getNome()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row mb-3">
            <label for="preco" class="form-label">Preço:</label>
            <input id="preco" name="preco" type="number" step="0.01" class="form-control"
                   value="<?= $ingresso->getPreco() ?? '' ?>">
        </div>

        <div class="row mb-3">
            <label for="quantidade" class="form-label">Quantidade:</label>
            <input id="quantidade" name="quantidade" type="number" class="form-control"
                   value="<?= $ingresso->getQuantidade() ?? '' ?>">
        </div>

        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="<?= BASE_URL . '/ingressos' ?>" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>