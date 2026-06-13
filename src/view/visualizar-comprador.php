<?php /** @var \model\Comprador $comprador */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title><?= htmlspecialchars($comprador->getNome()) ?></title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <h1><?= htmlspecialchars($comprador->getNome()) ?></h1>
    <p><strong>CPF:</strong> <?= htmlspecialchars($comprador->getCpf()) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($comprador->getEmail()) ?></p>
    <p><strong>Idade:</strong> <?= $comprador->getIdade() ?></p>

    <a href="<?= BASE_URL . '/compradores/' . $comprador->getId() . '/editar' ?>" class="btn btn-primary">Editar</a>
    <a href="<?= BASE_URL . '/compradores' ?>" class="btn btn-secondary">Voltar</a>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>