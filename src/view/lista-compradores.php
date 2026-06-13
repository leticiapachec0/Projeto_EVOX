<?php /** @var \model\Comprador[] $compradores */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Listagem de Compradores</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-3">
    <div class="row align-items-center">
        <div class="col-lg-9 col-md-6 col-sm-12">
            <h1>Listagem de Compradores</h1>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 text-end">
            <a class="btn btn-primary" href="<?= BASE_URL . '/compradores/novo' ?>">Cadastrar Comprador</a>
        </div>
    </div>

    <table class="table table-striped mt-3">
        <thead>
        <tr class="table-dark">
            <th>#</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Idade</th>
            <th>Opções</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($compradores as $comprador) : ?>
            <tr>
                <td><?= $comprador->getId() ?></td>
                <td><?= htmlspecialchars($comprador->getNome()) ?></td>
                <td><?= htmlspecialchars($comprador->getCpf()) ?></td>
                <td><?= htmlspecialchars($comprador->getEmail()) ?></td>
                <td><?= $comprador->getIdade() ?></td>
                <td>
                    <a class="btn btn-outline-primary" href="<?= BASE_URL . '/compradores/' . $comprador->getId() . '/editar' ?>">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
                    <a class="btn btn-outline-secondary" href="<?= BASE_URL . '/compradores/' . $comprador->getId() ?>">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    <form action="<?= BASE_URL . '/compradores/' . $comprador->getId() . '/remover' ?>" method="POST" style="display:inline">
                        <button class="btn btn-outline-danger" type="submit">
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