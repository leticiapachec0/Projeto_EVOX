<?php /** @var \model\Ingresso[] $ingressos */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Listagem de Ingressos</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-3">
    <div class="row align-items-center">
        <div class="col-lg-9 col-md-6 col-sm-12">
            <h1>Listagem de Ingressos</h1>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 text-end">
            <a class="btn btn-primary" href="<?= BASE_URL . '/ingressos/novo' ?>">Cadastrar Ingresso</a>
        </div>
    </div>

    <table class="table table-striped mt-3">
        <thead>
        <tr class="table-dark">
            <th>#</th>
            <th>Evento</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Opções</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($ingressos as $ingresso) : ?>
            <tr>
                <td><?= $ingresso->getId() ?></td>
                <td><?= htmlspecialchars($ingresso->getEvento()->getNome()) ?></td>
                <td>R$ <?= number_format($ingresso->getPreco(), 2, ',', '.') ?></td>
                <td><?= $ingresso->getQuantidade() ?></td>
                <td>
                    <a class="btn btn-outline-primary" href="<?= BASE_URL . '/ingressos/' . $ingresso->getId() . '/editar' ?>">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
                    <a class="btn btn-outline-secondary" href="<?= BASE_URL . '/ingressos/' . $ingresso->getId() ?>">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    <form action="<?= BASE_URL . '/ingressos/' . $ingresso->getId() . '/remover' ?>" method="POST" style="display:inline">
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