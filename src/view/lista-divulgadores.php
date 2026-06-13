<?php /** @var \model\Divulgador[] $divulgadores */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Listagem de Divulgadores</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-3">
    <div class="row align-items-center">
        <div class="col-lg-9 col-md-6 col-sm-12">
            <h1>Listagem de Divulgadores</h1>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 text-end">
            <a class="btn btn-primary" href="<?= BASE_URL . '/divulgadores/novo' ?>">Cadastrar Divulgador</a>
        </div>
    </div>

    <table class="table table-striped mt-3">
        <thead>
        <tr class="table-dark">
            <th>#</th>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>Email</th>
            <th>Opções</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($divulgadores as $divulgador) : ?>
            <tr>
                <td><?= $divulgador->getId() ?></td>
                <td><?= htmlspecialchars($divulgador->getNome()) ?></td>
                <td><?= htmlspecialchars($divulgador->getCnpj()) ?></td>
                <td><?= htmlspecialchars($divulgador->getEmail()) ?></td>
                <td>
                    <a class="btn btn-outline-primary" href="<?= BASE_URL . '/divulgadores/' . $divulgador->getId() . '/editar' ?>">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
                    <a class="btn btn-outline-secondary" href="<?= BASE_URL . '/divulgadores/' . $divulgador->getId() ?>">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    <form action="<?= BASE_URL . '/divulgadores/' . $divulgador->getId() . '/remover' ?>" method="POST" style="display:inline">
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