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
    <a href="<?= BASE_URL . '/eventos' ?>" class="text-muted text-decoration-none mb-4 d-inline-block">
        ← Voltar
    </a>

    <div class="row align-items-start mt-3">
        <!-- Imagem à esquerda -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
            <?php if ($evento->getUrlImagem()) : ?>
                <img src="<?= $evento->getUrlImagem() ?>"
                     alt="<?= htmlspecialchars($evento->getNome()) ?>"
                     style="width: 100%; height: 380px; object-fit: cover; border-radius: 16px;">
            <?php else : ?>
                <div style="width: 100%; height: 380px; background: linear-gradient(135deg, #2a0a1a, #1a1a1a); border-radius: 16px; display:flex; align-items:center; justify-content:center;">
                    <i class="bi bi-image" style="font-size: 4rem; color: #333;"></i>
                </div>
            <?php endif; ?>
        </div>

        <!-- Informações à direita -->
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h1 class="fw-bold mb-3"><?= htmlspecialchars($evento->getNome()) ?></h1>

            <p>
                <i class="bi bi-calendar-event" style="color: #e91e8c"></i>
                <?= $evento->getDataEvento()->format('d/m/Y') ?>
            </p>

            <p>
                <i class="bi bi-geo-alt-fill" style="color: #e91e8c"></i>
                <?= htmlspecialchars($evento->getLocal()) ?> — <?= htmlspecialchars($evento->getCidade()) ?>
            </p>

            <?php if ($evento->getDivulgador()) : ?>
                <p>
                    <i class="bi bi-megaphone-fill" style="color: #e91e8c"></i>
                    <?= htmlspecialchars($evento->getDivulgador()->getNome()) ?>
                </p>
            <?php endif; ?>

            <p class="mt-3 text-muted"><?= htmlspecialchars($evento->getDescricao()) ?></p>

            <div class="mt-4 d-flex align-items-center gap-3">
                <?php if (isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'comprador') : ?>
                    <a href="<?= BASE_URL . '/pedidos/novo/' . $evento->getId() ?>"
                       style="background: #e91e8c; color: white; padding: 12px 32px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 1.1rem;">
                        Comprar Ingresso
                    </a>
                <?php elseif (!isset($_SESSION['usuario_id'])) : ?>
                    <a href="<?= BASE_URL . '/login?redirect=pedidos/novo/' . $evento->getId() ?>"
                       style="background: #e91e8c; color: white; padding: 12px 32px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 1.1rem;">
                        Comprar Ingresso
                    </a>
                    <span style="color: #888; font-size: 0.85rem;">Faça login para comprar</span>
                <?php endif; ?>

                <?php if (isset($_SESSION['usuario_role']) && in_array($_SESSION['usuario_role'], ['admin', 'divulgador'])) : ?>
                    <a href="<?= BASE_URL . '/eventos/' . $evento->getId() . '/editar' ?>" class="btn btn-primary">
                        <i class="bi bi-pencil-fill"></i> Editar
                    </a>
                <?php endif; ?>

                <a href="<?= BASE_URL . '/eventos' ?>" class="btn btn-secondary">
                    Voltar
                </a>
            </div>
    </div>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>