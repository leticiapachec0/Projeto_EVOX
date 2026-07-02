<?php /** @var \model\Pedido[] $pedidos */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Listagem de Pedidos</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-3">
    <div class="row align-items-center">
        <div class="col-lg-9 col-md-6 col-sm-12">
            <h1>Listagem de Pedidos</h1>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 text-end">
            <a class="btn btn-primary" href="<?= BASE_URL . '/pedidos/novo' ?>">Cadastrar Pedido</a>
        </div>
    </div>

    <table class="table table-striped mt-3">
        <thead>
        <tr class="table-dark">
            <th>#</th>
            <th>Comprador</th>
            <th>Evento</th>
            <th>Data</th>
            <th>Quantidade</th>
            <th>Total</th>
            <th>Opções</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pedidos as $pedido) : ?>
            <tr>
                <td><?= $pedido->getId() ?></td>
                <td><?= htmlspecialchars($pedido->getComprador()->getNome()) ?></td>
                <td><?= htmlspecialchars($pedido->getEvento()->getNome()) ?></td>
                <td><?= $pedido->getData()->format('d/m/Y') ?></td>
                <td><?= $pedido->getQuantidade() ?></td>
                <td>R$ <?= number_format($pedido->getTotal(), 2, ',', '.') ?></td>
                <td>
                    <a class="btn btn-outline-primary" href="<?= BASE_URL . '/pedidos/editar/' . $pedido->getId() ?>">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
                    <a class="btn btn-outline-secondary" href="<?= BASE_URL . '/pedidos/ver/' . $pedido->getId() ?>">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    <form action="<?= BASE_URL . '/pedidos/remover/' . $pedido->getId() ?>" method="POST" style="display:inline">
                        <button class="btn btn-outline-danger btn-remover" type="button">
                            <i class="bi bi-trash2-fill"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>