<?php /** @var \model\Evento $evento */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title><?= htmlspecialchars($evento->getNome()) ?></title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <h1><?= htmlspecialchars($evento->getNome()) ?></h1>
    <p><strong>Descrição:</strong> <?= htmlspecialchars($evento->getDescricao()) ?></p>
    <p><strong>Cidade:</strong> <?= htmlspecialchars($evento->getCidade()) ?></p>
    <p><strong>Local:</strong> <?= htmlspecialchars($evento->getLocal()) ?></p>
    <p><strong>Data:</strong> <?= $evento->getDataEvento()->format('d/m/Y') ?></p>
    <?php if ($evento->getDivulgador()) : ?>
        <p><strong>Divulgador:</strong> <?= htmlspecialchars($evento->getDivulgador()->getNome()) ?></p>
    <?php endif; ?>

    <a href="<?= BASE_URL . '/eventos/' . $evento->getId() . '/editar' ?>" class="btn btn-primary">Editar</a>
    <a href="<?= BASE_URL . '/eventos' ?>" class="btn btn-secondary">Voltar</a>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>