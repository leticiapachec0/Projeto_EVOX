<?php /**
 * @var \model\Pedido $pedido
 * @var \model\Comprador[] $compradores
 * @var \model\Evento[] $eventos
 */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Cadastro de Pedido</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <h1><?= $pedido->getId() ? 'Editar Pedido' : 'Cadastrar Pedido' ?></h1>

    <form id="formCadastroPedido" action="<?= BASE_URL . '/pedidos/cadastrar' ?>" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($pedido->getId() ?? '') ?>">

        <div class="row mb-3">
            <label for="comprador_id" class="form-label">Comprador:</label>
            <select id="comprador_id" name="comprador_id" class="form-control">
                <option value="">Selecione um comprador</option>
                <?php foreach ($compradores as $comprador) : ?>
                    <option value="<?= $comprador->getId() ?>"
                        <?= $comprador->getId() == $pedido->getComprador()?->getId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($comprador->getNome()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row mb-3">
            <label for="evento_id" class="form-label">Evento:</label>
            <select id="evento_id" name="evento_id" class="form-control">
                <option value="">Selecione um evento</option>
                <?php foreach ($eventos as $evento) : ?>
                    <option value="<?= $evento->getId() ?>"
                        <?= $evento->getId() == $pedido->getEvento()?->getId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($evento->getNome()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row mb-3">
            <label for="data" class="form-label">Data:</label>
            <input id="data" name="data" type="date" class="form-control"
                   value="<?= $pedido->getData() ? $pedido->getData()->format('Y-m-d') : '' ?>">
        </div>

        <div class="row mb-3">
            <label for="quantidade" class="form-label">Quantidade:</label>
            <input id="quantidade" name="quantidade" type="number" class="form-control"
                   value="<?= $pedido->getQuantidade() ?? '' ?>">
        </div>

        <div class="row mb-3">
            <label for="total" class="form-label">Total (R$):</label>
            <input id="total" name="total" type="number" step="0.01" class="form-control"
                   value="<?= $pedido->getTotal() ?? '' ?>">
        </div>

        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="<?= BASE_URL . '/pedidos' ?>" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>