<?php /** @var \model\Evento[] $eventos */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Listagem de Eventos</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-3">
    <div class="row align-items-center mb-4">
        <div class="col-lg-9 col-md-6 col-sm-12">
            <h1>Eventos</h1>
            <p class="text-muted">Descubra as melhores experiências perto de você</p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 text-end">
            <a class="btn btn-primary" href="<?= BASE_URL . '/eventos/novo' ?>">
                <i class="bi bi-plus-circle"></i> Cadastrar Evento
            </a>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($eventos as $evento) : ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <?php if ($evento->getUrlImagem()) : ?>
                        <img src="<?= $evento->getUrlImagem() ?>"
                             class="card-img-top"
                             alt="<?= htmlspecialchars($evento->getNome()) ?>"
                             style="height: 180px; object-fit: cover; border-radius: 12px 12px 0 0;">
                    <?php else : ?>
                        <div style="height: 180px; background: linear-gradient(135deg, #2a0a1a, #1a1a1a); border-radius: 12px 12px 0 0; display:flex; align-items:center; justify-content:center;">
                            <i class="bi bi-image" style="font-size: 3rem; color: #333;"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($evento->getNome()) ?></h5>
                        <p class="card-text text-muted">
                            <i class="bi bi-geo-alt-fill"></i>
                            <?= htmlspecialchars($evento->getLocal()) ?> — <?= htmlspecialchars($evento->getCidade()) ?>
                        </p>
                        <p class="card-text">
                            <i class="bi bi-calendar-event"></i>
                            <?= $evento->getDataEvento()->format('d/m/Y') ?>
                        </p>
                        <p class="card-text small text-muted">
                            <?= htmlspecialchars(mb_strimwidth($evento->getDescricao(), 0, 80, '...')) ?>
                        </p>
                        <?php if ($evento->getDivulgador()) : ?>
                            <p class="card-text small">
                                <i class="bi bi-megaphone-fill"></i>
                                <?= htmlspecialchars($evento->getDivulgador()->getNome()) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div>
                            <a class="btn btn-sm btn-outline-primary"
                               href="<?= BASE_URL . '/eventos/' . $evento->getId() . '/editar' ?>">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-secondary"
                               href="<?= BASE_URL . '/eventos/' . $evento->getId() ?>">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <form action="<?= BASE_URL . '/eventos/' . $evento->getId() . '/remover' ?>"
                                  method="POST" style="display:inline">
                                <button class="btn btn-sm btn-outline-danger btn-remover" type="button">
                                    <i class="bi bi-trash2-fill"></i>
                                </button>
                            </form>
                        </div>
                        <small class="text-muted">#<?= $evento->getId() ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>