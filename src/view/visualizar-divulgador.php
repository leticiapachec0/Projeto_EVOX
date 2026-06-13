<?php /** @var \model\Divulgador $divulgador */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title><?= htmlspecialchars($divulgador->getNome()) ?></title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <h1><?= htmlspecialchars($divulgador->getNome()) ?></h1>
    <p><strong>CNPJ:</strong> <?= htmlspecialchars($divulgador->getCnpj()) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($divulgador->getEmail()) ?></p>

    <a href="<?= BASE_URL . '/divulgadores/' . $divulgador->getId() . '/editar' ?>" class="btn btn-primary">Editar</a>
    <a href="<?= BASE_URL . '/divulgadores' ?>" class="btn btn-secondary">Voltar</a>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>