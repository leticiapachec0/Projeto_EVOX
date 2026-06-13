<?php /** @var \model\Ingresso $ingresso */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Ingresso #<?= $ingresso->getId() ?></title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <h1>Ingresso #<?= $ingresso->getId() ?></h1>
    <p><strong>Evento:</strong> <?= htmlspecialchars($ingresso->getEvento()->getNome()) ?></p>
    <p><strong>Preço:</strong> R$ <?= number_format($ingresso->getPreco(), 2, ',', '.') ?></p>
    <p><strong>Quantidade:</strong> <?= $ingresso->getQuantidade() ?></p>

    <a href="<?= BASE_URL . '/ingressos/' . $ingresso->getId() . '/editar' ?>" class="btn btn-primary">Editar</a>
    <a href="<?= BASE_URL . '/ingressos' ?>" class="btn btn-secondary">Voltar</a>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>