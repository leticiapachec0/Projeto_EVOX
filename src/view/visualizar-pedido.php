<?php /** @var \model\Pedido $pedido */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Pedido #<?= $pedido->getId() ?></title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <h1>Pedido #<?= $pedido->getId() ?></h1>
    <p><strong>Comprador:</strong> <?= htmlspecialchars($pedido->getComprador()->getNome()) ?></p>
    <p><strong>Evento:</strong> <?= htmlspecialchars($pedido->getEvento()->getNome()) ?></p>
    <p><strong>Data:</strong> <?= $pedido->getData()->format('d/m/Y') ?></p>
    <p><strong>Quantidade:</strong> <?= $pedido->getQuantidade() ?></p>
    <p><strong>Total:</strong> R$ <?= number_format($pedido->getTotal(), 2, ',', '.') ?></p>

    <a href="<?= BASE_URL . '/pedidos/' . $pedido->getId() . '/editar' ?>" class="btn btn-primary">Editar</a>
    <a href="<?= BASE_URL . '/pedidos' ?>" class="btn btn-secondary">Voltar</a>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>