<?php /** @var \model\Pedido $pedido */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Recibo — EVOX</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5" style="max-width: 600px; margin: 0 auto;">

    <div style="background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 16px; padding: 40px; text-align: center;">

        <div style="font-size: 4rem; margin-bottom: 16px;">🎉</div>
        <h2 class="fw-bold" style="color: #e91e8c;">Compra Confirmada!</h2>
        <p style="color: #888;">Seu ingresso foi reservado com sucesso.</p>

        <hr style="border-color: #2a2a2a; margin: 24px 0;">

        <div style="text-align: left;">
            <h5 class="fw-bold mb-3">Detalhes do Pedido #<?= $pedido->getId() ?></h5>

            <div class="d-flex justify-content-between mb-2">
                <span style="color: #888;">Evento</span>
                <span><?= htmlspecialchars($pedido->getEvento()->getNome()) ?></span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span style="color: #888;">Local</span>
                <span><?= htmlspecialchars($pedido->getEvento()->getLocal()) ?></span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span style="color: #888;">Data do Evento</span>
                <span><?= $pedido->getEvento()->getDataEvento()->format('d/m/Y') ?></span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span style="color: #888;">Comprador</span>
                <span><?= htmlspecialchars($pedido->getComprador()->getNome()) ?></span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span style="color: #888;">Quantidade</span>
                <span><?= $pedido->getQuantidade() ?> ingresso(s)</span>
            </div>

            <hr style="border-color: #2a2a2a; margin: 16px 0;">

            <div class="d-flex justify-content-between">
                <strong>Total Pago</strong>
                <strong style="color: #e91e8c; font-size: 1.3rem;">
                    R$ <?= number_format($pedido->getTotal(), 2, ',', '.') ?>
                </strong>
            </div>
        </div>

        <hr style="border-color: #2a2a2a; margin: 24px 0;">

        <a href="<?= BASE_URL . '/eventos' ?>" class="btn btn-primary"
           style="border-radius: 50px; padding: 12px 32px;">
            Ver mais Eventos
        </a>
        <a href="<?= BASE_URL . '/perfil' ?>" class="btn btn-secondary ms-2"
           style="border-radius: 50px; padding: 12px 32px;">
            Meus Ingressos
        </a>
    </div>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>