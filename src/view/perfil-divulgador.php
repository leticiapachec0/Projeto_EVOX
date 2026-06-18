<?php

use utils\Sessao;

/** @var \model\Evento[] $eventos */ ?>
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

    <h4 class="fw-bold mb-3">
        <?= Sessao::eAdmin() ? 'Todos os Eventos' : 'Meus Eventos' ?>
    </h4>

    <?php if (empty($eventos)) : ?>
        <div style="background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 12px; padding: 40px; text-align: center;">
            <p style="color: #888; font-size: 1.1rem;">Você ainda não publicou nenhum evento.</p>
            <a href="<?= BASE_URL . '/eventos/novo' ?>" class="btn btn-primary" style="border-radius: 50px;">
                Publicar Evento
            </a>
        </div>
    <?php else : ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($eventos as $evento) : ?>
                <div class="col">
                    <div style="background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 12px; overflow: hidden;">
                        <?php if ($evento->getUrlImagem()) : ?>
                            <img src="<?= $evento->getUrlImagem() ?>"
                                 style="width: 100%; height: 160px; object-fit: cover;">
                        <?php else : ?>
                            <div style="width: 100%; height: 160px; background: linear-gradient(135deg, #2a0a1a, #1a1a1a); display:flex; align-items:center; justify-content:center;">
                                <i class="bi bi-image" style="font-size: 3rem; color: #333;"></i>
                            </div>
                        <?php endif; ?>
                        <div style="padding: 20px;">
                            <h5 class="fw-bold"><?= htmlspecialchars($evento->getNome()) ?></h5>
                            <p style="color: #888; margin-bottom: 4px;">
                                <i class="bi bi-geo-alt-fill" style="color: #e91e8c;"></i>
                                <?= htmlspecialchars($evento->getLocal()) ?> — <?= htmlspecialchars($evento->getCidade()) ?>
                            </p>
                            <p style="color: #888; margin-bottom: 16px;">
                                <i class="bi bi-calendar-event" style="color: #e91e8c;"></i>
                                <?= $evento->getDataEvento()->format('d/m/Y') ?>
                            </p>
                            <div class="d-flex gap-2">
                                <a href="<?= BASE_URL . '/eventos/' . $evento->getId() . '/editar' ?>"
                                   class="btn btn-sm btn-outline-primary" style="border-radius: 50px;">
                                    <i class="bi bi-pencil-fill"></i> Editar
                                </a>
                                <a href="<?= BASE_URL . '/eventos/' . $evento->getId() ?>"
                                   class="btn btn-sm btn-outline-secondary" style="border-radius: 50px;">
                                    <i class="bi bi-eye-fill"></i> Ver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>