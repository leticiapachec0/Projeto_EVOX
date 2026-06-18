<?php /** @var \model\Pedido[] $pedidos */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Meu Perfil — EVOX</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <div style="background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 16px; padding: 32px; margin-bottom: 32px;">
        <div class="d-flex align-items-center gap-3">
            <div style="width: 60px; height: 60px; background: #e91e8c; border-radius: 50%; display:flex; align-items:center; justify-content:center; font-size: 1.5rem; font-weight: 800; color: white;">
                <?= strtoupper(substr($_SESSION['usuario_nome'], 0, 1)) ?>
            </div>
            <div>
                <h4 class="fw-bold mb-0"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></h4>
                <span style="color: #888;"><?= htmlspecialchars($_SESSION['usuario_email']) ?></span>
                <span style="color: #e91e8c; font-size: 0.8rem; margin-left: 8px;">
                    (<?= $_SESSION['usuario_role'] ?>)
                </span>
            </div>
        </div>
    </div>

    <h4 class="fw-bold mb-3">Meus Ingressos</h4>

    <?php if (empty($pedidos)) : ?>
        <div style="background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 12px; padding: 40px; text-align: center;">
            <p style="color: #888; font-size: 1.1rem;">Você ainda não comprou nenhum ingresso.</p>
            <a href="<?= BASE_URL . '/eventos' ?>" class="btn btn-primary" style="border-radius: 50px;">
                Explorar Eventos
            </a>
        </div>
    <?php else : ?>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($pedidos as $pedido) : ?>
                <div class="col">
                    <div style="background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 12px; padding: 24px;">
                        <?php if ($pedido->getEvento()->getUrlImagem()) : ?>
                            <img src="<?= $pedido->getEvento()->getUrlImagem() ?>"
                                 style="width: 100%; height: 140px; object-fit: cover; border-radius: 8px; margin-bottom: 16px;">
                        <?php endif; ?>
                        <h5 class="fw-bold"><?= htmlspecialchars($pedido->getEvento()->getNome()) ?></h5>
                        <p style="color: #888; margin-bottom: 4px;">
                            <i class="bi bi-geo-alt-fill" style="color: #e91e8c;"></i>
                            <?= htmlspecialchars($pedido->getEvento()->getLocal()) ?> — <?= htmlspecialchars($pedido->getEvento()->getCidade()) ?>
                        </p>
                        <p style="color: #888; margin-bottom: 4px;">
                            <i class="bi bi-calendar-event" style="color: #e91e8c;"></i>
                            <?= $pedido->getEvento()->getDataEvento()->format('d/m/Y') ?>
                        </p>
                        <hr style="border-color: #2a2a2a;">
                        <div class="d-flex justify-content-between">
                            <span style="color: #888;"><?= $pedido->getQuantidade() ?> ingresso(s)</span>
                            <strong style="color: #e91e8c;">
                                R$ <?= number_format($pedido->getTotal(), 2, ',', '.') ?>
                            </strong>
                        </div>
                        <a href="<?= BASE_URL . '/pedidos/' . $pedido->getId() . '/recibo' ?>"
                           class="btn btn-outline-primary btn-sm mt-3 w-100"
                           style="border-radius: 50px;">
                            Ver Recibo
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>