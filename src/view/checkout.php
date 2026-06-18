<?php /**
 * @var \model\Pedido $pedido
 * @var \model\Evento $eventoSelecionado
 */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Checkout — EVOX</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5" style="max-width: 600px; margin: 0 auto;">
    <a href="<?= BASE_URL . '/eventos/' . $eventoSelecionado->getId() ?>"
       style="color: #888; text-decoration: none;">
        ← Voltar
    </a>

    <h1 class="mt-3 fw-bold">Checkout</h1>
    <p style="color: #888;">
        <?= htmlspecialchars($eventoSelecionado->getNome()) ?> —
        <?= htmlspecialchars($eventoSelecionado->getLocal()) ?>
    </p>

    <form action="<?= BASE_URL . '/pedidos/cadastrar' ?>" method="POST">
        <input type="hidden" name="evento_id" value="<?= $eventoSelecionado->getId() ?>">
        <input type="hidden" name="comprador_email" value="<?= $_SESSION['usuario_email'] ?>">
        <input type="hidden" name="data" value="<?= date('Y-m-d') ?>">

        <!-- Ingressos disponíveis -->
        <?php
        $ingressos = $eventoSelecionado->getIngressos();
        $preco = 0;
        if (!empty($ingressos) && count($ingressos) > 0) {
            $preco = $ingressos[0]->getPreco();
        }
        ?>

        <div style="background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 12px; padding: 24px; margin: 24px 0;">
            <h5 class="fw-bold mb-3">Ingressos</h5>
            <div class="d-flex justify-content-between align-items-center">
                <span style="color: #888;">
                    R$ <?= number_format($preco, 2, ',', '.') ?> / ingresso
                </span>
                <div class="d-flex align-items-center gap-3">
                    <button type="button" onclick="alterarQtd(-1)"
                            style="background: #2a2a2a; border: none; color: white; width: 32px; height: 32px; border-radius: 50%; cursor: pointer;">−</button>
                    <span id="qtdDisplay">1</span>
                    <button type="button" onclick="alterarQtd(1)"
                            style="background: #2a2a2a; border: none; color: white; width: 32px; height: 32px; border-radius: 50%; cursor: pointer;">+</button>
                </div>
            </div>
            <input type="hidden" name="quantidade" id="quantidade" value="1">

            <hr style="border-color: #2a2a2a; margin: 16px 0;">

            <div class="d-flex justify-content-between align-items-center">
                <strong>Total</strong>
                <strong id="totalDisplay" style="color: #e91e8c; font-size: 1.3rem;">
                    R$ <?= number_format($preco, 2, ',', '.') ?>
                </strong>
            </div>
            <input type="hidden" name="total" id="total" value="<?= $preco ?>">
        </div>

        <button type="submit" class="btn btn-primary w-100"
                style="border-radius: 50px; padding: 14px; font-size: 1.1rem; font-weight: 700;">
            Confirmar Compra
        </button>
    </form>
</div>

<script>
    let quantidade = 1;
    const preco = <?= $preco ?>;

    function alterarQtd(delta) {
        quantidade = Math.max(1, quantidade + delta);
        document.getElementById('qtdDisplay').textContent = quantidade;
        document.getElementById('quantidade').value = quantidade;
        const total = (preco * quantidade).toFixed(2);
        document.getElementById('total').value = total;
        document.getElementById('totalDisplay').textContent =
            'R$ ' + total.replace('.', ',');
    }
</script>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>